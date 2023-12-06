<?php
/**
*
* @package phpBB Extension - Image convert
* @copyright (c) 2017 Vlad
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace vlad\image_convert\migrations;

class image_convert_1_0_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return;
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_schema()
	{
		return array(
		);
	}

	public function revert_schema()
	{
		return array(
		);
	}

	public function update_data()
	{
		return array(
			// Current version
			array('config.add', array('image_convert_version', '1.0.0')),
		);
	}
}
