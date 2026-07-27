<?php
/**
 * Group Subscription transaction operator interface.
 *
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace stevotvr\groupsub\operator;

interface transaction_interface
{
	/**
	 * Process a verified Stripe event.
	 *
	 * @param array $event
	 * @return bool
	 */
	public function process_stripe_event(array $event);

	public function get_transactions($start, $limit, $sort_field, $sort_desc);

	public function count_transactions();
}
