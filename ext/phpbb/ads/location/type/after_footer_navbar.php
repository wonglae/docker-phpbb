<?php
/**
 *
 * Advertisement management. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\ads\location\type;

class after_footer_navbar extends base
{
	/**
	 * {@inheritDoc}
	 */
	public function get_id()
	{
		return 'after_footer_navbar';
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_category()
	{
		return self::CAT_BOTTOM_OF_PAGE;
	}
}
