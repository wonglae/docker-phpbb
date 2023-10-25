<?php
/**
 *
 * Custom CSS. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace towang\advancedbbcode;

class ext extends \phpbb\extension\base
{
	/**
	 * {@inheritdoc}
	 */
	public function is_enableable()
	{
		return phpbb_version_compare(PHPBB_VERSION, '3.3.9', '>=');
	}
}
