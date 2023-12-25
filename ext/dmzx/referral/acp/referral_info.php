<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\referral\acp;

class referral_info
{
	function module()
	{
		return array(
			'filename'		=> '\dmzx\referral\acp\referral_module',
			'title'			=> 'ACP_REFERRAL',
			'modes'			=> array(
				'config'		=> array('title' => 'ACP_REFERRAL_CONFIG', 'auth' => 'ext_dmzx/referral && acl_a_board', 'cat' => array('ACP_CAT_DOT_MODS')),
				'contests'	 	=> array('title' => 'ACP_REFERRAL_CONTESTS', 'auth' => 'ext_dmzx/referral && acl_a_board', 'cat' => array('ACP_CAT_DOT_MODS')),
				'referrers'		=> array('title' => 'ACP_REFERRERS_LIST', 'auth' => 'ext_dmzx/referral && acl_a_board', 'cat' => array('ACP_CAT_DOT_MODS')),
			),
		);
	}
}
