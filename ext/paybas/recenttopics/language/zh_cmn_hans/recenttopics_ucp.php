<?php
/**
 *
 * @package Recent Topics Extension
 * English translation by PayBas
 *
 * @copyright (c) 2015 PayBas
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 * Based on the original NV Recent Topics by Joas Schilling (nickvergessen)
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
// ’ « » “ ” …
//

$lang = array_merge(
	$lang, array(
	'RT_ENABLE'              => '显示最新的话题',
	'RT_BOTTOM'              => '显示在底部',
	'RT_SIDE'                => '显示在侧边栏',
	'RT_TOP'                 => '显示在顶部',
	'RT_LOCATION'            => '选择位置',
	'RT_LOCATION_EXP'        => '选择要显示最近话题的位置。',
	'RT_NUMBER'              => '显示最近话题的数量',
	'RT_NUMBER_EXP'          => '每页显示的最大主题数。',
	'RT_SORT_START_TIME'     => '按主题开始时间排序最近话题',
	'RT_SORT_START_TIME_EXP' => '而不是按最后发布时间排序。',
	'RT_UNREAD_ONLY'         => '仅在最近话题中显示未读主题',
	)
);
