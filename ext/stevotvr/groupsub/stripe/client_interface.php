<?php
/**
 * Stripe client interface.
 *
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace stevotvr\groupsub\stripe;

interface client_interface
{
	/** @return string */
	public function get_secret_key();

	/** @return string */
	public function get_webhook_secret();

	/** @param string $value @return bool */
	public function is_valid_secret_key($value);

	/** @param string $value @return bool */
	public function is_valid_webhook_secret($value);

	/** @return bool */
	public function is_configured();

	/** @return bool */
	public function is_test_mode();

	/**
	 * @param array $params Checkout Session parameters
	 * @return array
	 * @throws \RuntimeException
	 */
	public function create_checkout_session(array $params);

	/**
	 * Verify and decode a Stripe webhook.
	 *
	 * @param string $payload Raw request body
	 * @param string $signature Stripe-Signature header
	 * @return array|false
	 */
	public function construct_webhook_event($payload, $signature);
}
