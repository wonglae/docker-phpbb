<?php
/**
 *
 * 2FA extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2015 Paul Sohier
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

$lang = array_merge(
	$lang, array(
		'ACP_TFA_SETTINGS'			=> '双重身份验证设置',

		// As we are re-using the acp_board template, we can't add custom stuff to that page.
		// As such, we do need to have some HTML here :(.
		'ACP_TFA_SETTINGS_EXPLAIN'	=> 'Here you can set the configuration for two factor settings.
										The suggested configuration option for the requirement is either do not require Two factor authentication,
										or only require it for the ACP login. <br /><br />
										There are for the U2F security key some browser requirements:
										<ul>
											<li>Google Chrome (At least version 41)</li>
										</ul>
										Not supported:
										<ul>
											<li>Internet Explorer</li>
											<li>Edge</li>
											<li>Firefox</li>
											<li>Safari</li>
										</ul>
										<p>However, several browser vendors promised it might be supported in a newer release.
										When a browser does not meet these requirements, the user won’t be able to select U2F.</p>
										
										<h2>Receiving support</h2>
										<p>Support is only provided on www.phpbb.com, in the extension <a href="https://www.phpbb.com/customise/db/extension/phpbb_two_factor_authentication/" target="_blank">customisations database</a>. Please make sure to read the FAQ before asking your questions.</p>
										
										<h2>Want to support the development of this extension?</h2>
										<p>This extension is developed fully in my free time, however you can help me by providing a small donation to get this extension being developed.</p>
										<ul>
											<li>Become a sponsor on github: <a href="https://github.com/sponsors/paul999" target="_blank">https://github.com/sponsors/paul999</a></li>
											<li>Make a paypal donation: <a href="https://paypal.me/sohier" target="_blank">https://paypal.me/sohier</a></li>
											<li>Make a donation via bunq: <a href="https://bunq.me/Paul999" target="_blank">https://bunq.me/Paul999</a></li>
										</ul>
										',
		'TFA_REQUIRES_SSL'			=> '您似乎正在使用不安全的连接。此扩展需要安全的SSL连接才能使某些安全密钥正常工作。除非您启用了安全连接到您的论坛，否则用户将无法选择这些选项。',

		'TFA_MODE'						=> '双重身份验证模式',
		'TFA_MODE_EXPLAIN'				=> '您可以选择哪些用户（如果有）需要使用双重身份验证模式。选择“禁用双重身份验证”将完全禁用该功能。',
		'TFA_DISABLED'					=> '禁用双重身份验证',
		'TFA_NOT_REQUIRED'				=> '不要求双重身份验证',
		'TFA_REQUIRED_FOR_ACP_LOGIN'	=> '仅要求ACP登录时进行双重身份验证',
		'TFA_REQUIRED_FOR_ADMIN'		=> '要求所有管理员进行双重身份验证',
		'TFA_REQUIRED_FOR_MODERATOR'	=> '要求所有版主和管理员进行双重身份验证',
		'TFA_REQUIRED'					=> '要求所有用户进行双重身份验证',

		'TFA_ACP'           => '要求管理员在管理面板中进行双重身份验证',
		'TFA_ACP_EXPLAIN'   => '当设置为否时，管理员在登录ACP时不需要使用双重身份验证密钥。不建议禁用此功能。'
	)
);
