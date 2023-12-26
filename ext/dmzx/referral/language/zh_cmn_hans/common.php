<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'TOP_FIVE_REFERRERS'	=> '前五名推荐人',
	'NO_REFERRERS'			=> '还没有推荐人。',
	'REFERRAL_CONTEST'		=> '推荐竞赛',
	'REFERRALS'				=> '推荐',
	'CONTEST_INFO'			=> '竞赛信息',
	'CONTEST_DURATION'		=> '持续时间',
	'CONTEST_START_DATE'	=> '开始日期',
	'CONTEST_END_DATE'		=> '结束日期',
	'CONTEST_STATUS'		=> '状态',
	'CONTEST_IN_PROGRESS' 	=> '进行中',
	'CONTEST_OVER'			=> '结束',
	'TOP_THREE_REFERRERS' 	=> '前三名推荐人',
));
