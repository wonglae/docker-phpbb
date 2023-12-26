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
		'TFA_REQUIRED_KEY_MISSING'      => '‘本论坛的管理员要求您添加双重身份验证密钥以访问（有限的）论坛部分，但您当前没有（兼容的）密钥注册到您的帐户中。您可以在此处添加新的安全密钥%s。
												<br />出于安全原因，论坛已被禁止访问，直到您向您的帐户添加安全密钥。在添加安全密钥时，您可能需要填写密码！
												<br />请注意，您现在也将退出登录。',

		'TFA_REQUIRED_KEY_AVAILABLE_BUT_UNUSABLE' => '本论坛的管理员要求您为您的帐户添加双重身份验证密钥以访问（有限的）论坛部分。您已经注册了双重身份验证密钥，但它们目前与您当前的浏览器或设置不兼容，或者以其他方式不可用。
														<br />出于安全原因，我们不允许已经注册密钥的用户在完全登录之前添加新密钥。您可以尝试使用之前有效的浏览器登录，或者联系%s论坛管理员%s请求重置您的双重身份验证密钥。',
		// Controller
		'ERR_NO_MATCHING_REQUEST'       => '未找到匹配的请求',
		'ERR_NO_MATCHING_REGISTRATION'  => '未找到匹配的注册',
		'ERR_AUTHENTICATION_FAILURE'    => '身份验证失败', 
		'ERR_UNMATCHED_CHALLENGE'       => '注册挑战不匹配',
		'ERR_ATTESTATION_SIGNATURE'     => '证明签名不匹配',
		'ERR_ATTESTATION_VERIFICATION'  => '无法验证证明证书',
		'ERR_BAD_RANDOM'                => '无法获得良好的随机源',
		'ERR_COUNTER_TOO_LOW'           => '计数器太低',
		'ERR_PUBKEY_DECODE'             => '公钥解码失败',
		'ERR_BAD_UA_RETURNING'          => '用户代理返回错误',
		'ERR_OLD_OPENSSL'               => 'OpenSSL 必须至少是 1.0.0 版本，当前版本为 %s',
		'UNKNOWN_ERROR'                 => '验证您的安全密钥时发生未知错误。请稍后再试。',

		'ERR_TFA_NO_REQUEST_FOUND_IN_SESSION'	=> '在当前会话中找不到请求。您是否通过其他页面提交？',
		'TFA_NOT_REGISTERED'									=> '使用的安全密钥未注册到您的帐户',

		'FTA_NO_RESPONSE'                   => '未收到响应',
		'TFA_SELECT_KEY'                    => '选择密钥类型',
		'TFA_NO_RESPONSE_RECEIVED'          => '我们没有从您的 U2F 安全密钥收到响应。您按了按钮吗？',
		'TFA_NOT_SUPPORTED'                 => '浏览器不支持',
		'TFA_BROWSER_SEEMS_NOT_SUPPORTED'   => '抱歉，目前仅支持 Google Chrome。',
		'TFA_INSERT_KEY'                    => '插入您的安全密钥',
		'TFA_INSERT_KEY_EXPLAIN'            => '将您的安全密钥插入计算机并单击“已插入密钥”。',
		'TFA_START_AUTH'                    => '已插入密钥',
		'TFA_NO_ACCESS'											=> '似乎您无权访问此页面？',
		'TFA_UNABLE_TO_UPDATE_SESSION'			=> '无法更新会话。请联系论坛管理员',
		'TFA_DISABLED'											=> '已禁用双重身份验证',

		'TFA_OTP_KEY_LOG'						=> 'OTP 密钥',
		'TFA_OTP_KEY_LOG_EXPLAIN'		=> '请打开身份验证器应用程序并接管下面文本字段中显示的当前密钥',
		'TFA_INCORRECT_KEY'					=> '提供的密钥不正确。',
		'TFA_NO_KEY_PROVIDED'				=> '未提供密钥',
		'TFA_KEY_REQUIRED'					=> '请提供您的安全密钥',

		'TFA_BACKUP_KEY'			=> '备份密钥',
		'TFA_OTP'					=> 'OTP',
		'TFA_U2F'					=> 'U2F',

		'TFA_CP_TXT'				=> 'phpBB 双重身份验证',
		'TFA_CP_NAME'				=> 'paul999',

		'TFA_BACKUP_KEY_LOG'				=> '备份密钥',
		'TFA_BACKUP_KEY_LOG_EXPLAIN'		=> '请提供一个以前未使用过的备份密钥。',

		'TFA_DOUBLE_PRIORITY'				=> '模块%s的选择优先级（%d）已用于模块%s',

		'TFA_SOMETHING_WENT_WRONG'			=> '请求期间发生了错误。请稍后再试。',

		// Module names
		'MODULE_U2F'        => 'U2F',

	)
);
