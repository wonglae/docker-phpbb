<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\referral\migrations;

class referral_module extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_REFERRAL')),
			array('module.add', array(
			'acp', 'ACP_REFERRAL', array(
					'module_basename'	=> '\dmzx\referral\acp\referral_module', 'modes' => array('config','contests','referrers'),
				),
			)),

			// Add UCP category
			array('module.add', array(
				'ucp',
				false,
				'UCP_REFERRAL'
			)),
			// Add UCP preferences module
			array('module.add', array(
				'ucp',
				'UCP_REFERRAL',
				array(
					'module_basename'	=> '\dmzx\referral\ucp\ucp_referral_module',
					'modes'				=> array('statistics','referrals','invite'),
				),
			)),
		);
	}
}
