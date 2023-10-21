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
	'GROUPSUB_NOTIFICATION_GROUP'										=> '组订阅通知',
	'GROUPSUB_NOTIFICATION_TYPE_WARN'								=> '您的订阅即将到期',
	'GROUPSUB_NOTIFICATION_TYPE_EXPIRED'						=> '您的订阅已过期',
	'GROUPSUB_NOTIFICATION_TYPE_STARTED'						=> '您的订阅已开始',
	'GROUPSUB_NOTIFICATION_TYPE_ADMIN_STARTED'			=> '用户的订阅已开始',

	'GROUPSUB_NOTIFICATION_WARN_TITLE'							=> '订阅即将到期',
	'GROUPSUB_NOTIFICATION_WARN_REFERENCE'					=> '您对<strong>%1$s</strong>的订阅将于%2$s到期。',

	'GROUPSUB_NOTIFICATION_EXPIRED_TITLE'						=> '订阅已过期',
	'GROUPSUB_NOTIFICATION_EXPIRED_REFERENCE'				=> '您对<strong>%s</strong>的订阅已过期。',

	'GROUPSUB_NOTIFICATION_CANCELLED_TITLE'					=> '订阅已取消',
	'GROUPSUB_NOTIFICATION_CANCELLED_REFERENCE'			=> '您对<strong>%s</strong>的订阅已被取消。',

	'GROUPSUB_NOTIFICATION_STARTED_TITLE'						=> '订阅已开始',
	'GROUPSUB_NOTIFICATION_STARTED_REFERENCE'				=> '您对<strong>%s</strong>的订阅已开始。',

	'GROUPSUB_NOTIFICATION_ADMIN_STARTED_TITLE'			=> '用户的订阅已开始',
	'GROUPSUB_NOTIFICATION_ADMIN_STARTED_REFERENCE'	=> '%s已经订阅了<strong>%s</strong>。',
));
