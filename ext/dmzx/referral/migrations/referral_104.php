<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\referral\migrations;

class referral_104 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\dmzx\referral\migrations\referral_103',
		);
	}
	public function update_data()
	{
		return array(
			// Update config
			array('config.update', array('referral_mod_version', '1.0.4')),
		);
	}
}
