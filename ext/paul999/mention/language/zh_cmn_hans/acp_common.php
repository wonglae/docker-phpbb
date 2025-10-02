<?php
/**
 *
 * phpBB mentions. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016, paul999, https://www.phpbbextensions.io
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'MENTION_LENGTH'                => '@提醒最小长度',
	'MENTION_LENGTH_EXPLAIN'        => '显示@提醒下拉菜单前的最小文本长度。在较大的论坛上，您可能需要增加此值。',
	'MENTION_COLOR'                 => '@提醒颜色',
	'MENTION_COLOR_EXPLAIN'         => '此颜色用于在帖子中高亮显示被@的用户。只能使用十六进制值。',
	'MENTION_COLOR_INVALID'         => '选择的@提醒颜色 (%s) 无效。请选择有效的十六进制颜色，不要包含 #',
	'MENTION_MAX_RESULTS'			=> '@提醒最大结果数',
	'MENTION_MAX_RESULTS_EXPLAIN'	=> '下拉菜单中显示的最大用户数。在较大的论坛上，您可能需要减少此值',
	'MENTION_LARGE_GROUPS'			=> '@提醒大群组大小',
	'MENTION_LARGE_GROUPS_EXPLAIN'	=> '如果群组成员数超过指定数量，则需要"可以@提醒大群组"权限。'
));
