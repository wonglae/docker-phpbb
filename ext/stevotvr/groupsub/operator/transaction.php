<?php
/**
 * Stripe transaction operator.
 *
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace stevotvr\groupsub\operator;

use phpbb\event\dispatcher_interface;
use phpbb\log\log_interface;
use phpbb\request\request_interface;
use stevotvr\groupsub\operator\currency_interface;
use stevotvr\groupsub\operator\subscription_interface;

class transaction extends operator implements transaction_interface
{
	protected $phpbb_dispatcher;
	protected $request;
	protected $log;
	protected $currency;
	protected $sub_operator;
	protected $trans_table;
	protected $events_table;
	protected $phpbb_users_table;

	public function setup(request_interface $request, log_interface $log, currency_interface $currency, dispatcher_interface $phpbb_dispatcher, subscription_interface $sub_operator, $trans_table, $events_table, $phpbb_users_table)
	{
		$this->request = $request;
		$this->log = $log;
		$this->currency = $currency;
		$this->phpbb_dispatcher = $phpbb_dispatcher;
		$this->sub_operator = $sub_operator;
		$this->trans_table = $trans_table;
		$this->events_table = $events_table;
		$this->phpbb_users_table = $phpbb_users_table;
	}

	/** @inheritDoc */
	public function process_stripe_event(array $event)
	{
		$event_id = isset($event['id']) ? (string) $event['id'] : '';
		$event_type = isset($event['type']) ? (string) $event['type'] : '';
		if (!$this->valid_stripe_id($event_id, 'evt_') || $event_type === '' || !isset($event['data']['object']))
		{
			return false;
		}

		if ($this->event_processed($event_id))
		{
			return true;
		}

		$object = $event['data']['object'];
		$accepted = true;
		switch ($event_type)
		{
			case 'checkout.session.completed':
				// Delayed methods send a later async_payment_succeeded event.
				if (isset($object['payment_status']) && $object['payment_status'] === 'paid')
				{
					$accepted = $this->fulfill_checkout($object, (bool) $event['livemode']);
				}
			break;

			case 'checkout.session.async_payment_succeeded':
				$accepted = $this->fulfill_checkout($object, (bool) $event['livemode']);
			break;

			case 'charge.refunded':
				if (!empty($object['refunded']) && isset($object['amount'], $object['amount_refunded'])
					&& (int) $object['amount_refunded'] >= (int) $object['amount'])
				{
					$accepted = $this->revoke_payment(isset($object['payment_intent']) ? $object['payment_intent'] : '', 'refunded');
				}
			break;

			case 'charge.dispute.created':
				$accepted = $this->revoke_payment(isset($object['payment_intent']) ? $object['payment_intent'] : '', 'disputed');
			break;
		}

		if ($accepted)
		{
			$this->mark_event_processed($event_id, $event_type);
		}

		return $accepted;
	}

	/**
	 * Grant permanent access for a paid Checkout Session.
	 */
	protected function fulfill_checkout(array $session, $livemode)
	{
		$session_id = isset($session['id']) ? (string) $session['id'] : '';
		$payment_intent = isset($session['payment_intent']) ? (string) $session['payment_intent'] : '';
		if (!$this->valid_stripe_id($session_id, 'cs_') || !$this->valid_stripe_id($payment_intent, 'pi_'))
		{
			return false;
		}

		if (isset($session['mode']) && $session['mode'] !== 'payment')
		{
			return false;
		}

		$sql = 'SELECT trans_status FROM ' . $this->trans_table . "
				WHERE trans_id = '" . $this->db->sql_escape($payment_intent) . "'";
		$this->db->sql_query($sql);
		$status = $this->db->sql_fetchfield('trans_status');
		$this->db->sql_freeresult();
		if ($status !== false)
		{
			// Never re-grant a purchase that was already refunded or disputed.
			return true;
		}

		$metadata = isset($session['metadata']) && is_array($session['metadata']) ? $session['metadata'] : array();
		$user_id = isset($metadata['phpbb_user_id']) ? (int) $metadata['phpbb_user_id'] : 0;
		$term_id = isset($metadata['groupsub_term_id']) ? (int) $metadata['groupsub_term_id'] : 0;
		if ($user_id <= ANONYMOUS || $term_id <= 0
			|| (isset($session['client_reference_id']) && (int) $session['client_reference_id'] !== $user_id))
		{
			return false;
		}

		$sql = 'SELECT user_id FROM ' . $this->phpbb_users_table . ' WHERE user_id = ' . $user_id;
		$this->db->sql_query($sql);
		$valid_user = (int) $this->db->sql_fetchfield('user_id') === $user_id;
		$this->db->sql_freeresult();
		if (!$valid_user)
		{
			return false;
		}

		$term = $this->container->get('stevotvr.groupsub.entity.term')->load($term_id);
		if (!$term || $term->get_currency() !== 'CNY' || $term->get_price() !== 10000 || $term->get_length() !== 0)
		{
			$this->log->add('critical', ANONYMOUS, false, 'LOG_GROUPSUB_TRANS_NO_TERM', false, array($term_id));
			return false;
		}

		$currency = isset($session['currency']) ? strtoupper($session['currency']) : '';
		$amount = isset($session['amount_total']) ? (int) $session['amount_total'] : -1;
		if ($currency !== 'CNY' || $amount !== 10000)
		{
			return false;
		}

		$sub_id = $this->sub_operator->create_subscription($term, $user_id);
		$customer = isset($session['customer']) && is_string($session['customer']) ? $session['customer'] : '';
		$this->insert_transaction($payment_intent, $session_id, $customer, !$livemode, $amount, $currency, $user_id, $sub_id, $term_id);

		return true;
	}

	/**
	 * Revoke access after a full refund or dispute.
	 */
	protected function revoke_payment($payment_intent, $reason)
	{
		if (!$this->valid_stripe_id($payment_intent, 'pi_'))
		{
			return false;
		}

		$sql = 'SELECT sub_id, user_id, trans_status FROM ' . $this->trans_table . "
				WHERE trans_id = '" . $this->db->sql_escape($payment_intent) . "'";
		$this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow();
		$this->db->sql_freeresult();
		if (!$row)
		{
			// Returning non-success asks Stripe to retry if events arrived out of order.
			return false;
		}
		if ($row['trans_status'] !== 'paid')
		{
			return true;
		}

		$this->sub_operator->delete_subscription((int) $row['sub_id']);
		$sql = 'UPDATE ' . $this->trans_table . "
				SET trans_status = '" . $this->db->sql_escape($reason) . "'
				WHERE trans_id = '" . $this->db->sql_escape($payment_intent) . "'";
		$this->db->sql_query($sql);
		$this->log->add('admin', (int) $row['user_id'], false, 'LOG_GROUPSUB_STRIPE_REVOKED', false, array($payment_intent, $reason));

		return true;
	}

	protected function event_processed($event_id)
	{
		$sql = 'SELECT 1 FROM ' . $this->events_table . "
				WHERE event_id = '" . $this->db->sql_escape($event_id) . "'";
		$this->db->sql_query($sql);
		$processed = (bool) $this->db->sql_fetchfield();
		$this->db->sql_freeresult();
		return $processed;
	}

	protected function mark_event_processed($event_id, $event_type)
	{
		$data = array(
			'event_id' => $event_id,
			'event_type' => substr($event_type, 0, 64),
			'event_time' => time(),
		);
		$sql = 'INSERT INTO ' . $this->events_table . ' ' . $this->db->sql_build_array('INSERT', $data);
		$this->db->sql_query($sql);
	}

	protected function valid_stripe_id($value, $prefix)
	{
		return is_string($value) && strpos($value, $prefix) === 0
			&& strlen($value) <= 128 && preg_match('/^[A-Za-z0-9_]+$/', $value);
	}

	protected function insert_transaction($payment_intent, $session_id, $customer, $test, $amount, $currency, $user_id, $sub_id, $term_id)
	{
		$data = array(
			'trans_id' => $payment_intent,
			'trans_test' => (bool) $test,
			'trans_payer' => substr($customer, 0, 128),
			'trans_session' => $session_id,
			'trans_status' => 'paid',
			'trans_amount' => (int) $amount,
			'trans_currency' => $currency,
			'trans_time' => time(),
			'user_id' => (int) $user_id,
			'sub_id' => (int) $sub_id,
			'term_id' => (int) $term_id,
		);
		$sql = 'INSERT INTO ' . $this->trans_table . ' ' . $this->db->sql_build_array('INSERT', $data);
		$this->db->sql_query($sql);

		$txn_id = $payment_intent;
		$payer_id = $customer;
		$test_ipn = $test;
		$mc_currency = $currency;
		$mc_gross = $this->currency->format_value($currency, $amount, false, false);
		$vars = array('user_id', 'sub_id', 'txn_id', 'payer_id', 'test_ipn', 'mc_currency', 'mc_gross');
		extract($this->phpbb_dispatcher->trigger_event('stevotvr.groupsub.payment_received', compact($vars)));
	}

	/** @inheritDoc */
	public function get_transactions($start, $limit, $sort_field, $sort_desc)
	{
		$sql_ary = array(
			'SELECT' => 't.*, u.username, u.user_colour',
			'FROM' => array($this->trans_table => 't', $this->phpbb_users_table => 'u'),
			'WHERE' => 't.user_id = u.user_id',
			'ORDER_BY' => $sort_field . ($sort_desc ? ' DESC' : ' ASC'),
		);
		$sql = $this->db->sql_build_query('SELECT', $sql_ary);
		$this->db->sql_query_limit($sql, $limit, $start);
		$rows = $this->db->sql_fetchrowset();
		$this->db->sql_freeresult();
		return $rows;
	}

	/** @inheritDoc */
	public function count_transactions()
	{
		$sql = 'SELECT COUNT(trans_id) AS trans_count FROM ' . $this->trans_table;
		$this->db->sql_query($sql);
		$count = $this->db->sql_fetchfield('trans_count');
		$this->db->sql_freeresult();
		return (int) $count;
	}
}
