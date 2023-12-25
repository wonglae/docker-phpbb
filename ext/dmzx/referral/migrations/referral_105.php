<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\referral\migrations;

class referral_105 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return [
			'\dmzx\referral\migrations\referral_104',
		];
	}
	public function update_data()
	{
		return [
			// Update config
			['config.update', ['referral_mod_version', '1.0.5']],
		];
	}
}
