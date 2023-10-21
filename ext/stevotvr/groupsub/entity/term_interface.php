<?php
/**
 *
 * Group Subscription. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Steve Guidetti, https://github.com/stevotvr
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace stevotvr\groupsub\entity;

/**
 * Group Subscription term entity interface.
 */
interface term_interface extends entity_interface
{
	/**
	 * @return int|null The ID of the package associated with this term
	 */
	public function get_package();

	/**
	 * @param int $package_id The ID of the package associated with this term
	 *
	 * @return term_interface This object for chaining
	 *
	 * @throws \stevotvr\groupsub\exception\out_of_bounds
	 */
	public function set_package($package_id);

	/**
	 * @return int|null The price of this term in the currency subunit
	 */
	public function get_price();

	/**
	 * @param int $price The price of this term in the currency subunit
	 *
	 * @return term_interface This object for chaining
	 *
	 * @throws \stevotvr\groupsub\exception\out_of_bounds
	 */
	public function set_price($price);

	/**
	 * @return string The currency code of the price of this term
	 */
	public function get_currency();

	/**
	 * @param string $currency The currency code of the price of this term
	 *
	 * @return term_interface This object for chaining
	 *
	 * @throws \stevotvr\groupsub\exception\unexpected_value
	 */
	public function set_currency($currency);

	/**
	 * @return int|null The subscription length of this term in days
	 */
	public function get_length();

	/**
	 * @param int $length The subscription length of this term in days
	 *
	 * @return term_interface This object for chaining
	 *
	 * @throws \stevotvr\groupsub\exception\out_of_bounds
	 */
	public function set_length($length);

	/**
	 * @return int The sorting order of this term
	 */
	public function get_order();

	/**
	 * @param int $order The sorting order of this term
	 *
	 * @return term_interface This object for chaining
	 *
	 * @throws \stevotvr\groupsub\exception\out_of_bounds
	 */
	public function set_order($order);
}
