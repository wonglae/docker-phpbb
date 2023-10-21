<?php
/**
 *
 * Group Subscription. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, Steve Guidetti, https://github.com/stevotvr
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace stevotvr\groupsub\controller;

/**
 * Group Subscription ACP controller interface.
 */
interface acp_base_interface
{
	/**
	 * @param string $page_url The URL for the current page
	 */
	public function set_page_url($page_url);

	/**
	 * Add the required languages for the controller
	 */
	public function add_lang();
}
