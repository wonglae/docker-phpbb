<?php
/**
 * Stripe webhook controller.
 *
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace stevotvr\groupsub\controller;

use phpbb\log\log_interface;
use phpbb\request\request_interface;
use stevotvr\groupsub\operator\transaction_interface;
use stevotvr\groupsub\stripe\client_interface;
use Symfony\Component\HttpFoundation\Response;

class stripe_webhook_controller
{
	protected $request;
	protected $stripe;
	protected $transactions;
	protected $log;

	public function __construct(request_interface $request, client_interface $stripe, transaction_interface $transactions, log_interface $log)
	{
		$this->request = $request;
		$this->stripe = $stripe;
		$this->transactions = $transactions;
		$this->log = $log;
	}

	/** @return Response */
	public function handle()
	{
		$payload = file_get_contents('php://input');
		$signature = (string) $this->request->header('Stripe-Signature');
		$event = $this->stripe->construct_webhook_event($payload === false ? '' : $payload, $signature);
		if ($event === false)
		{
			return new Response('', 400);
		}

		if ((bool) $event['livemode'] === $this->stripe->is_test_mode())
		{
			return new Response('', 400);
		}

		try
		{
			$accepted = $this->transactions->process_stripe_event($event);
		}
		catch (\Exception $e)
		{
			$this->log->add('critical', ANONYMOUS, false, 'LOG_GROUPSUB_STRIPE_WEBHOOK_ERROR', false, array($event['id'], $event['type'], $e->getMessage()));
			return new Response('', 500);
		}

		return new Response('', $accepted ? 200 : 400);
	}
}
