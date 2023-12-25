<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\referral\migrations;

class referral_data extends \phpbb\db\migration\migration
{
	var $ext_version = '1.0.2';

	public function update_data()
	{
		return array(
			// Add config
			array('config.add', array('referral_mod_version', $this->ext_version)),
			array('config.add', array('top_five_referrers', '0', '0')),
			array('config.add', array('user_referrals_viewtopic', '0', '0')),
			array('config.add', array('user_referrals_profile', '0', '0')),
			array('config.add', array('referral_contests_display', '0', '0')),
		);
	}
}
