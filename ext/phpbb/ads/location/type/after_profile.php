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

class after_profile extends base
{
	/**
	 * {@inheritDoc}
	 */
	public function get_id()
	{
		return 'after_profile';
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_category()
	{
		return self::CAT_OTHER;
	}

	/**
	 * {@inheritDoc}
	 */
	public function will_display()
	{
		return strpos($this->user->page['page_name'], 'memberlist') !== false && strpos($this->user->page['query_string'], 'viewprofile') !== false;
	}
}
