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
	'ACP_GROUPSUB_SETTINGS_STRIPE'			=> 'Stripe 结账',
	'ACP_GROUPSUB_ACTIVE'					=> '启用付款',
	'ACP_GROUPSUB_ACTIVE_EXPLAIN'			=> '显示会员套餐，并允许会员进入 Stripe 结账页面。',
	'ACP_GROUPSUB_STRIPE_SECRETS'			=> '服务器凭据',
	'ACP_GROUPSUB_STRIPE_SECRETS_EXPLAIN'	=> 'STRIPE_SECRET_KEY 和 STRIPE_WEBHOOK_SECRET 从受保护的环境变量中读取，不会存储在 phpBB 中。',
	'ACP_GROUPSUB_STRIPE_CONFIGURED'		=> '两个 Stripe 密钥均已配置。',
	'ACP_GROUPSUB_STRIPE_NOT_CONFIGURED'	=> 'Stripe 密钥缺失或格式不正确。',
	'ACP_GROUPSUB_STRIPE_MODE'				=> 'API 模式',
	'ACP_GROUPSUB_STRIPE_TEST'				=> '测试',
	'ACP_GROUPSUB_STRIPE_LIVE'				=> '正式',
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
	'ACP_GROUPSUB_ERROR_STRIPE_CONFIG' => '配置两个 Stripe 环境密钥后才能启用付款。',
));
