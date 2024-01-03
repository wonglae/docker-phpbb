<?php
/**
 *
 * prefixed [English]
 *
 * @package language
 * @copyright (c) 2005 phpBB Group
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
	$lang = [];
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

$lang = array_merge($lang, [
	'ACP_PREFIXED_MANAGEMENT'		=> '主题标签管理',
	'ACP_PREFIXED_MANAGE'			=> '管理标签',
	'ACP_PREFIXED_MANAGE_EXPLAIN'	=> '在这个页面，你可以管理你的论坛的主题标签。',

	'ACP_PREFIXES'			=> '主题标签',
	'PREFIX'				=> '标签',
	'PREFIX_PARSED'			=> '输出',
	'ADD_PREFIX'			=> '新建标签',

	'PREFIX_TITLE'			=> '标签',
	'PREFIX_TITLE_EXPLAIN'	=> '这是实际显示在主题标题前面的内容。支持BBCode。可以使用一些标记，它们会在应用标签时替换为实际数据。',
	'PREFIX_SHORT'			=> '简称',
	'PREFIX_SHORT_EXPLAIN'	=> '这是一个唯一的标识符，帮助你区分不同的标签。',
	'PREFIX_FORUMS'			=> '论坛ID',
	'PREFIX_FORUMS_EXPLAIN'	=> '指定哪些论坛可以使用这个标签，用","分隔。',
	'PREFIX_GROUPS'			=> '用户组ID',
	'PREFIX_GROUPS_EXPLAIN'	=> '指定哪些用户组可以应用这个标签，用","分隔。',
	'PREFIX_USERS'			=> '用户ID',
	'PREFIX_USERS_EXPLAIN'	=> '指定哪些用户可以应用这个标签（覆盖用户组设置），用","分隔。',

	'DELETE_PREFIX'				=> '确定要删除指定的标签吗？',
	'DELETE_PREFIX_CONFIRM'		=> '标签及其所有实例将被删除。这个操作无法撤销。',

'PREFIX_ADDED_SUCCESS'		=> '标签添加成功。',
'PREFIX_EDITED_SUCCESS'		=> '标签更新成功。',
'PREFIX_DELETED_SUCCESS'	=> '标签删除成功。',
'NO_PREFIX_ID_SPECIFIED'	=> '你必须指定一个有效的标签ID。',
]);
