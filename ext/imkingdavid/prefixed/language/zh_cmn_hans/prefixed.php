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
	'POSTING_PREFIXES'	=> '主题标签',
	'POSTING_PREFIXES_USED' => '已添加主题标签',
	'NO_PREFIX' => '无标签',

	'PREFIXED_TOKEN_USERNAME'			=> '{USERNAME}',
	'PREFIXED_TOKEN_USERNAME_EXPLAIN'	=> '此标签将替换为将标签应用于主题的用户的用户名。',
	'PREFIXED_TOKEN_POSTER'				=> '{POSTER}',
	'PREFIXED_TOKEN_POSTER_EXPLAIN'		=> '此标签将替换为主题发布者的用户名。',
	'PREFIXED_TOKEN_DATE'				=> '{DATE}',
	'PREFIXED_TOKEN_DATE_EXPLAIN'		=> '此标签将替换为将标签应用于主题的日期。',
]);
