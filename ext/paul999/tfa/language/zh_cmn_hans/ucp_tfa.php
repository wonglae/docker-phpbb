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
		'TFA_NO_KEYS'				=> '没有找到双重认证密钥。您可以在下面添加一个。',
		'TFA_KEYS'					=> '在这个页面上，您可以管理您的双重认证密钥。
										您可以为您的账户添加多个密钥。
										如果您丢失了密钥，请确保从您的账户中删除它们！
										<br /><br />
										根据论坛管理员选择的配置，
										您可能需要在访问论坛之前添加一个安全密钥。
										<br /><br />
										一些安全密钥（如 U2F 标准）目前只在特定的
										浏览器中工作。因此，可能存在这样的情况，即您的账户已经注册了一些密钥，但是由于没有找到与您的浏览器兼容的有效密钥，而导致无法访问论坛。建议您至少注册一些备用密钥，并将它们存放在一个安全的地方。',
		'TFA_NO_MODE'				=> '无模式',
		'TFA_KEYS_DELETED'			=> '已删除选中的密钥。',
		'TFA_NEW'                   => '添加新密钥',
		'TFA_ERROR'					=> '似乎出了些问题...',
		'TFA_REG_FAILED'			=> '注册失败，错误原因： ',
		'TFA_REG_EXISTS'			=> '您提供的密钥已经注册到您的账户',
		'TFA_ADD_KEY'				=> '注册新密钥',
		'TFA_KEY_ADDED'				=> '您的安全密钥已经添加，可以使用了。',
		'TFA_INSERT_KEY'			=> '插入您的安全密钥，并按下密钥上的按钮',
		'TFA_REGISTERED'			=> '密钥已注册',
		'TFA_LAST_USED'				=> '密钥最后使用时间',
		'TFA_MODULE_NOT_FOUND'		=> '没有找到选中的模块（%s）',
		'TFA_MODULE_NO_REGISTER'	=> '选中的模块不接受新密钥的注册',
		'TFA_SELECT_NEW'			=> '添加新密钥',
		'TFA_ADD_NEW_U2F_KEY'		=> '为您的账户添加一个新的 U2F 密钥',
		'TFA_ADD_NEW_OTP_KEY'		=> '为您的账户添加一个新的 OTP 密钥',
		'TFA_ADD_OTP_KEY_EXPLAIN'	=> '用一个Authenticator应用（如 Microsoft Authenticator）扫描下面的二维码，或者在应用中填入下一个密钥：%s。然后，通过提供您的认证器应用中的一个密钥来确认。',
		'TFA_OTP_KEY'				=> 'OTP 密钥',
		'TFA_OTP_INVALID_KEY'		=> '提供的密钥无效。',
		'TFA_KEYTYPE'				=> '密钥类型',
		'TFA_KEY_NOT_USED'			=> '尚未使用',
		'TFA_KEY'                   => '备份密钥',
		'TFA_BACKUP_KEY_EXPLAIN'	=> '下面是为防止您丢失密钥或密钥不工作而生成的备份密钥。
									请确保将这些密钥存放在一个安全的地方。<br />
									一般来说，您只应该在最后的手段时使用备份密钥。<br /><br />
									当所有密钥都用完时，您可以生成新的密钥。 ',
	)
);
