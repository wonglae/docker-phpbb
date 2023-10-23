<?php
/**
 *
 * Custom CSS. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace towang\advancedbbcode\acp;

/**
 * Custom CSS ACP module info.
 */
class main_info
{
	public function module()
	{
		return array(
			'filename'	=> '\towang\advancedbbcode\acp\main_module',
			'title'		=> 'ACP_TOWANG_ADVANCEDBBOCDE_TITLE',
			'modes'		=> array(
				'manage'	=> array(
					'title'	=> 'ACP_TOWANG_ADVANCEDBBOCDE_TITLE',
					'auth'	=> 'ext_towang/advancedbbcode && acl_a_board',
					'cat'	=> array('ACP_TOWANG_ADVANCEDBBOCDE_TITLE')
				),
			),
		);
	}
}
