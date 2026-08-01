<?php
/**
 * Add a customer-facing payment reference to Stripe transactions.
 *
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace stevotvr\groupsub\migrations;

use phpbb\db\migration\migration;

class version_1_3_1 extends migration
{
	static public function depends_on()
	{
		return array('\stevotvr\groupsub\migrations\version_1_3_0');
	}

	public function update_schema()
	{
		return array(
			'add_columns' => array(
				$this->table_prefix . 'groupsub_trans' => array(
					'trans_reference' => array('VCHAR:32', ''),
				),
			),
			'add_index' => array(
				$this->table_prefix . 'groupsub_trans' => array(
					'trans_reference' => array('trans_reference'),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_keys' => array(
				$this->table_prefix . 'groupsub_trans' => array('trans_reference'),
			),
			'drop_columns' => array(
				$this->table_prefix . 'groupsub_trans' => array('trans_reference'),
			),
		);
	}
}
