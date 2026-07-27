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
	'GROUPSUB_PACKAGE_LIST'					=> '捐赠',
	'GROUPSUB_NO_PACKAGES'					=> '没有可用的订阅。',
	'GROUPSUB_NO_DESC'							=> '没有可用的描述。',
	'GROUPSUB_SUBSCRIPTION'					=> '订阅',
	'GROUPSUB_PRICE'								=> '价格',
	'GROUPSUB_LENGTH'								=> '长度',
	'GROUPSUB_LENGTH_UNLIMITED'			=> '无限期',
	'GROUPSUB_SUBSCRIBE'						=> '订阅',
	'GROUPSUB_RENEW'								=> '续订订阅',
	'GROUPSUB_CHOOSE_TERM'					=> '订阅 %s',
	'GROUPSUB_SUBSCRIBED'						=> '您已经永久订阅',
	'GROUPSUB_SUBSCRIBED_UNTIL'			=> '您已订阅至 %s',
	'GROUPSUB_CONFIRM'							=> '确认订阅 %s',
	'GROUPSUB_BUY_WITH_STRIPE'				=> '购买终身 VIP',
	'GROUPSUB_ALREADY_SUBSCRIBED'			=> '您已经拥有此终身会员资格。',
	'GROUPSUB_PLAN_INVALID'					=> 'VIP 套餐必须设置为人民币 100 元、无限期。',
	'GROUPSUB_STRIPE_NOT_CONFIGURED'		=> 'Stripe 尚未配置，付款功能暂时不可用。',
	'GROUPSUB_STRIPE_UNAVAILABLE'			=> 'Stripe 结账暂时不可用，请稍后重试。',

	'GROUPSUB_RETURN_TITLE'					=> '谢谢',
	'GROUPSUB_RETURN'								=> '已订阅',
	'GROUPSUB_RETURN_UNLIMITED'			=> '<strong>无限期</strong>',
	'GROUPSUB_RETURN_MESSAGE'				=> '您已经订阅了<strong>%1$s</strong>，为期%2$s。请等待几分钟，以便处理您的付款并激活您的订阅。',

	'GROUPSUB_DECIMAL_SEPARATOR'		=> '.',
	'GROUPSUB_THOUSANDS_SEPARATOR'	=> ',',

	'GROUPSUB_DAYS'		=> array(
		1	=> '天',
		2	=> '天',
	),
	'GROUPSUB_WEEKS'	=> array(
		1	=> '周',
		2	=> '周',
	),
	'GROUPSUB_MONTHS'	=> array(
		1	=> '月',
		2	=> '月',
	),
	'GROUPSUB_YEARS'	=> array(
		1	=> '年',
		2	=> '年',
	),
));
