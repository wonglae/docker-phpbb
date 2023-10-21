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
	'ACP_GROUPSUB_SETTINGS_TITLE'			=> '组订阅设置',
	'ACP_GROUPSUB_SETTINGS_SAVED'			=> '成功保存组订阅选项',
	'ACP_GROUPSUB_SETTINGS_PAYPAL'			=> 'PayPal 设置',
	'ACP_GROUPSUB_PP_SANDBOX'				=> '启用沙盒模式',
	'ACP_GROUPSUB_PP_SANDBOX_EXPLAIN'		=> '沙盒模式允许您测试 PayPal 支付，而无需使用真实资金。',
	'ACP_GROUPSUB_PP_SB_BUSINESS'			=> '沙盒电子邮件地址',
	'ACP_GROUPSUB_PP_SB_BUSINESS_EXPLAIN'	=> '这是您的 PayPal 沙盒帐户的电子邮件地址。',
	'ACP_GROUPSUB_PP_BUSINESS'				=> 'PayPal 电子邮件地址',
	'ACP_GROUPSUB_PP_BUSINESS_EXPLAIN'		=> '这是将接受付款的 PayPal 帐户的电子邮件地址',
	'ACP_GROUPSUB_SETTINGS_GENERAL'			=> '常规选项',
	'ACP_GROUPSUB_NOTIFY_ADMINS'			=> '通知管理员',
	'ACP_GROUPSUB_NOTIFY_ADMINS_EXPLAIN'	=> '如果启用，具有<em>“Can view users’ subscriptions”</em>权限的管理员将收到所有新订阅的通知。',
	'ACP_GROUPSUB_HEADER'					=> '页面标题',
	'ACP_GROUPSUB_HEADER_EXPLAIN'			=> '在所有订阅页面顶部显示的信息',
	'ACP_GROUPSUB_FOOTER'					=> '页面页脚',
	'ACP_GROUPSUB_FOOTER_EXPLAIN'			=> '在所有订阅页面底部显示的信息。',
	'ACP_GROUPSUB_COLLAPSE_TERMS'			=> '折叠条款列表',
	'ACP_GROUPSUB_COLLAPSE_TERMS_EXPLAIN'	=> '如果选项超过此数量，则将为套餐列出条款列表。',
	'ACP_GROUPSUB_SETTINGS_DEFAULTS'		=> '套餐默认值',
	'ACP_GROUPSUB_DEFAULT_CURRENCY'			=> '默认货币',
	'ACP_GROUPSUB_DEFAULT_CURRENCY_EXPLAIN'	=> '这是所有新套餐的默认货币，可以按套餐覆盖。',
	'ACP_GROUPSUB_WARN_TIME'				=> '警告时间',
	'ACP_GROUPSUB_WARN_TIME_EXPLAIN'		=> '在订阅到期前多少天通知订户。',
	'ACP_GROUPSUB_GRACE'					=> '宽限期',
	'ACP_GROUPSUB_GRACE_EXPLAIN'			=> '订阅结束后多少天才从组中删除用户。',

	'ACP_GROUPSUB_ERROR_CURRENCY'	=> '您必须选择有效货币。',
));
