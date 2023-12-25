<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\referral\ucp;

class ucp_referral_info
{
	function module()
	{
		global $config;

		return array(
			'filename'	=> '\dmzx\referral\ucp\ucp_referral_module',
			'title'		=> 'UCP_REFERRAL',
			'version'	=> $config['referral_version'],
			'modes'		=> array(
				'statistics'	=> array('title' => 'UCP_STATISTICS', 'auth' => 'ext_dmzx/referral', 'cat' => array('UCP_REFERRAL')),
				'referrals'		=> array('title' => 'UCP_REFERRALS', 'auth' => 'ext_dmzx/referral', 'cat' => array('UCP_REFERRAL')),
				'invite'		=> array('title' => 'UCP_INVITE', 'auth' => 'ext_dmzx/referral', 'cat' => array('UCP_REFERRAL')),
			),
		);
	}
}
