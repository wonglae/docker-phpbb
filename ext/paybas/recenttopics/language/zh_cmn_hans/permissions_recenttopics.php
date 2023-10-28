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

$lang = array_merge(
	$lang, array(
	'ACL_U_RT_VIEW'            => '最新的话题：可以查看最新的话题。',
	'ACL_U_RT_ENABLE'          => '最新的话题：可以启用或禁用显示最新的话题。',
	'ACL_U_RT_LOCATION'        => '最新的话题：可以选择最近话题块的显示位置。',
	'ACL_U_RT_SORT_START_TIME' => '最新的话题：可以更改主题排序顺序。',
	'ACL_U_RT_UNREAD_ONLY'     => '最新的话题：可以更改设置以仅显示未读主题。',
	'ACL_U_RT_NUMBER'          => '最新的话题：可以更改每页显示的最新主题数量设置。',
	)
);
