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
	'UCP_REFERRAL'			=> 'Referrals',
	'UCP_STATISTICS'	 	=> 'View statistics',
	'UCP_REFERRALS'			=> 'View referrals',
	'UCP_INVITE'		 	=> 'Invite friends',
	'REFERRAL_LINK'			=> 'Your referral link',
	'YOUR_STATISTICS'		=> 'Your statistics',
	'MEMBERS_REFERRED'		=> 'Members referred',
	'INVITATIONS_SENT'		=> 'Invitations sent',
	'CONTESTS_WON'			=> 'Contests won',
	'RECIPIENTS'		 	=> 'Recipient(s)',
	'RECIPIENTS_EXPLAIN' 	=> 'You can send invitation to multiple recipients by entering each email address on a new line.',
	'SENDER_EMAIL'			=> 'Your email',
	'MESSAGE_EXPLAIN'		=> 'Your referral link will be inserted automatically at the end of your message.',
	'INVITATION_SENT'		=> 'Your invitation has been successfully sent!',
	'FORM_ERROR'		 	=> 'You have to fill in all the fields.',
	'YOUR_REFERRALS'	 	=> 'Your referrals',
	'NO_REFERRALS'			=> 'You don’t have any referrals yet.',
));
