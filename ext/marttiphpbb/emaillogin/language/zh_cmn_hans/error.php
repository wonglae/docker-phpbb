<?php

/**
* phpBB Extension - marttiphpbb emaillogin
* @copyright (c) 2018 - 2020 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'MARTTIPHPBB_EMAILLOGIN_ERROR_NO_EMAIL'
		=> '您需要指定电子邮件才能登录。',
	'MARTTIPHPBB_EMAILLOGIN_ERROR_NO_USERNAME_OR_EMAIL'
		=> '‘您需要指定用户名或电子邮件才能登录。',
	'MARTTIPHPBB_EMAILLOGIN_ERROR_NO_VALID_EMAIL'
		=> '电子邮件地址 %1$s 无效。',
	'MARTTIPHPBB_EMAILLOGIN_LOGIN_ERROR_EMAIL'
		=> '您指定的电子邮件 (%1$s) 不正确。请检查您的电子邮件并重试。如果您继续遇到问题，请联系 %2$s管理员%3$s。',
	'MARTTIPHPBB_EMAILLOGIN_ERROR_EMAIL_DUPLICATE'
		=> '无法使用电子邮件 %1$s，因为它在数据库中出现多次。请联系 %2$s管理员%3$s。',		
]);
