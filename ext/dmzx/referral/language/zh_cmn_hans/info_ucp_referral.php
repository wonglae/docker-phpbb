<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
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
	'UCP_REFERRAL'			=> '推荐',
	'UCP_STATISTICS'	 	=> '查看统计',
	'UCP_REFERRALS'			=> '查看推荐',
	'UCP_INVITE'		 	=> '邀请朋友',
	'REFERRAL_LINK'			=> '您的推荐链接',
	'YOUR_STATISTICS'		=> '您的统计',
	'MEMBERS_REFERRED'		=> '推荐的会员',
	'INVITATIONS_SENT'		=> '发送的邀请',
	'CONTESTS_WON'			=> '赢得的竞赛',
	'RECIPIENTS'		 	=> '收件人',
	'RECIPIENTS_EXPLAIN' 	=> '您可以通过在新行上输入每个电子邮件地址来向多个收件人发送邀请。',
	'SENDER_EMAIL'			=> '您的电子邮件',
	'MESSAGE_EXPLAIN'		=> '您的推荐链接将自动插入到您的消息的末尾。',
	'INVITATION_SENT'		=> '您的邀请已成功发送！',
	'FORM_ERROR'		 	=> '您必须填写所有字段。',
	'YOUR_REFERRALS'	 	=> '您的推荐',
	'NO_REFERRALS'			=> '您还没有任何推荐。',
));
