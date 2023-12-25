<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\referral\migrations;

class referral_schema extends \phpbb\db\migration\migration
{
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'referrals'	=> array(
					'COLUMNS'	=> array(
						'referral_id'			=> array('UINT', null, 'auto_increment'),
						'referral_username' 	=> array('VCHAR', ''),
						'referrer_id'			=> array('UINT', 0),
						'referrer_username' 	=> array('VCHAR', ''),
						'referral_since'		=> array('TIMESTAMP', 0),
					),
					'PRIMARY_KEY' => 'referral_id',
				),
				$this->table_prefix . 'referral_contests'	=> array(
					'COLUMNS'	=> array(
						'contest_id'			=> array('UINT', null, 'auto_increment'),
						'contest_name'			=> array('VCHAR', ''),
						'contest_description' 	=> array('TEXT', ''),
						'contest_condition'		=> array('UINT', 0),
						'contest_start_date'	=> array('TIMESTAMP', 0),
						'contest_end_date'		=> array('TIMESTAMP', 0),
						'contest_duration'		=> array('VCHAR', ''),
						'contest_winner'		=> array('VCHAR', ''),
					),
					'PRIMARY_KEY' => 'contest_id',
				),
			),
			'add_columns'	=> array(
				$this->table_prefix . 'users' => array(
					'user_referrals' 			=> array('UINT', 0),
				),
			),
		);
	}

	public function revert_schema()
	{
		return 	array(
			'drop_tables' => array(
				$this->table_prefix . 'referrals',
				$this->table_prefix . 'referral_contests',
			),
			'drop_columns'	=> array(
				$this->table_prefix . 'users' => array(
					'user_referrals',
				),
			),
		);
	}
}
