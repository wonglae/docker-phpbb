<?php
/**
 *
 * Group Subscription. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, Steve Guidetti, https://github.com/stevotvr
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
	'ACP_GROUPSUB_TITLE'					=> '组订阅',
	'ACP_GROUPSUB_SETTINGS'				=> '设置',
	'ACP_GROUPSUB_MANAGE_PKGS'		=> '管理套餐',
	'ACP_GROUPSUB_MANAGE_SUBS'		=> '管理订阅',
	'ACP_GROUPSUB_TRANSACTIONS'		=> '查看交易',

	'ACP_USER_GROUPSUB'						=> '订阅',

	'LOG_GROUPSUB_TRANS_NO_TERM'	=> 'process_transaction: 无法获取 term_id=%d 的条款。',
	'LOG_GROUPSUB_STRIPE_REVOKED'	=> '<strong>已撤销 Stripe VIP 付款</strong><br>付款意图：%1$s<br>原因：%2$s',
	'LOG_GROUPSUB_STRIPE_WEBHOOK_ERROR' => '<strong>Stripe Webhook 处理失败</strong><br>事件：%1$s（%2$s）<br>错误：%3$s',
	'LOG_GROUPSUB_STRIPE_CHECKOUT_ERROR' => '<strong>Stripe 结账创建失败</strong><br>期限：%1$d<br>错误：%2$s',
));
