<?php
/**
 * Stripe payment migration.
 *
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace stevotvr\groupsub\migrations;

use phpbb\db\migration\migration;

class version_1_3_0 extends migration
{
	static public function depends_on()
	{
		return array('\stevotvr\groupsub\migrations\version_1_2_0');
	}

	public function update_schema()
	{
		return array(
			'change_columns' => array(
				$this->table_prefix . 'groupsub_trans' => array(
					'trans_id' => array('VCHAR:128', ''),
					'trans_payer' => array('VCHAR:128', ''),
				),
			),
			'add_columns' => array(
				$this->table_prefix . 'groupsub_trans' => array(
					'trans_session' => array('VCHAR:128', ''),
					'trans_status' => array('VCHAR:16', 'paid'),
					'term_id' => array('UINT', 0),
				),
			),
			'add_index' => array(
				$this->table_prefix . 'groupsub_trans' => array(
					'trans_session' => array('trans_session'),
				),
			),
			'add_tables' => array(
				$this->table_prefix . 'groupsub_stripe_events' => array(
					'COLUMNS' => array(
						'event_id' => array('VCHAR:128', ''),
						'event_type' => array('VCHAR:64', ''),
						'event_time' => array('UINT:11', 0),
					),
					'PRIMARY_KEY' => 'event_id',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables' => array($this->table_prefix . 'groupsub_stripe_events'),
			'drop_keys' => array(
				$this->table_prefix . 'groupsub_trans' => array('trans_session'),
			),
			'drop_columns' => array(
				$this->table_prefix . 'groupsub_trans' => array('trans_session', 'trans_status', 'term_id'),
			),
			'change_columns' => array(
				$this->table_prefix . 'groupsub_trans' => array(
					'trans_id' => array('VCHAR:17', ''),
					'trans_payer' => array('VCHAR:13', ''),
				),
			),
		);
	}

	public function update_data()
	{
		return array(
			array('config.remove', array('stevotvr_groupsub_pp_sandbox')),
			array('config.remove', array('stevotvr_groupsub_pp_sb_business')),
			array('config.remove', array('stevotvr_groupsub_pp_business')),
			array('config.update', array('stevotvr_groupsub_currency', 'CNY')),
		);
	}

	public function effectively_installed()
	{
		return $this->db_tools->sql_table_exists($this->table_prefix . 'groupsub_stripe_events');
	}
}
