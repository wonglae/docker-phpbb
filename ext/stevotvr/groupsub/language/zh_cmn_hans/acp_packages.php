<?php
/**
 *
 * Group Subscription. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Steve Guidetti, https://github.com/stevotvr
 * @license GNU General Public License, version 2 (GPL-2.0)
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
	'ACP_GROUPSUB_MANAGE_PKGS_TITLE'			=> '管理订阅套餐',
	'ACP_GROUPSUB_MANAGE_PKGS_EXPLAIN'			=> '在这里，您可以管理可用的订阅套餐。',
	'ACP_GROUPSUB_NO_PKGS'						=> '无订阅套餐',
	'ACP_GROUPSUB_PKG_ADD'						=> '创建订阅套餐',
	'ACP_GROUPSUB_PKG_ADD_SUCCESS'				=> '成功创建订阅套餐',
	'ACP_GROUPSUB_PKG_EDIT'						=> '编辑订阅套餐',
	'ACP_GROUPSUB_PKG_EDIT_SUCCESS'				=> '成功保存订阅套餐详细信息',
	'ACP_GROUPSUB_PKG_DELETE_CONFIRM'			=> '确定要删除此订阅套餐吗?',
	'ACP_GROUPSUB_PKG_DELETE_SUCCESS'			=> '成功删除订阅套餐',
	'ACP_GROUPSUB_PKG_DETAILS'					=> '套餐详情',
	'ACP_GROUPSUB_PKG_ENABLE'					=> '启用套餐',
	'ACP_GROUPSUB_PKG_ENABLE_EXPLAIN'			=> '使此套餐对用户可用。',
	'ACP_GROUPSUB_PKG_IDENT'					=> '套餐标识符',
	'ACP_GROUPSUB_PKG_IDENT_EXPLAIN'			=> '用于标识套餐的唯一字符串。该值必须仅包含 a-z、0-9、_，并以字母开头。',
	'ACP_GROUPSUB_PKG_NAME'						=> '套餐名称',
	'ACP_GROUPSUB_PKG_DESC'						=> '套餐描述',
	'ACP_GROUPSUB_PKG_START'					=> '订阅开始操作',
	'ACP_GROUPSUB_PKG_END'						=> '订阅结束操作',
	'ACP_GROUPSUB_PKG_GROUPS_ADD'				=> '将订户添加到组',
	'ACP_GROUPSUB_PKG_GROUPS_ADD_EXPLAIN'		=> '订户将被添加到此处选择的组中。',
	'ACP_GROUPSUB_PKG_GROUPS_REMOVE'			=> '从组中删除订户',
	'ACP_GROUPSUB_PKG_GROUPS_REMOVE_EXPLAIN'	=> '如果订户对该组有另一个活动订阅，则<strong>不会</strong>删除该订户。',
	'ACP_GROUPSUB_PKG_DEFAULT_GROUP'			=> '设置默认组',
	'ACP_GROUPSUB_PKG_DEFAULT_GROUP_EXPLAIN'	=> '将订户的默认组设置为此处选择的组。',
	'ACP_GROUPSUB_PKG_TERM_ADD'					=> '添加条款',
	'ACP_GROUPSUB_PKG_TERMS'					=> '订阅条款',
	'ACP_GROUPSUB_PKG_PRICE'					=> '订阅价格',
	'ACP_GROUPSUB_PKG_PRICE_EXPLAIN'			=> '输入订阅价格。',
	'ACP_GROUPSUB_PKG_LENGTH'					=> '订阅长度',
	'ACP_GROUPSUB_PKG_LENGTH_EXPLAIN'			=> '输入订阅长度。输入 0 表示无限期订阅。',

	'ACP_GROUPSUB_NAME'		=> '名称',
	'ACP_GROUPSUB_TERMS'	=> '条款',
	'ACP_GROUPSUB_PRICE'	=> '价格',
	'ACP_GROUPSUB_LENGTH'	=> '长度',
	'ACP_GROUPSUB_MORE'		=> '+%d 更多…',

	'ACP_GROUPSUB_EXPIRES_UNLIMITED'	=> '无限期',

	'ACP_GROUPSUB_ERROR_MISSING_TERMS'	=> '一个套餐必须至少有一个条款才能启用。',
));
