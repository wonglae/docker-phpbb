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
	'ACL_CAT_GROUPSUB'									=> '组订阅',
	'ACL_A_GROUPSUB_SETTINGS'						=> '可以更改组订阅设置',
	'ACL_A_GROUPSUB_PACKAGES'						=> '可以创建或更改订阅套餐',
	'ACL_A_GROUPSUB_SUBSCRIPTIONS'			=> '可以查看用户的订阅',
	'ACL_A_GROUPSUB_SUBSCRIPTIONS_EDIT'	=> '可以更改或取消用户的订阅',
	'ACL_A_GROUPSUB_TRANSACTIONS'				=> '可以查看 PayPal 交易',
));
