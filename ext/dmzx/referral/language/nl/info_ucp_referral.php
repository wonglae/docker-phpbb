<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* Nederlandse vertaling @ Solidjeuh <https://www.froddelpower.be>
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
	'UCP_REFERRAL'			=> 'Doorverwijzers',
	'UCP_STATISTICS'	 	=> 'Bekijk statistieken',
	'UCP_REFERRALS'			=> 'Bekijk doorverwijzers',
	'UCP_INVITE'		 	=> 'Nodig vrienden uit',
	'REFERRAL_LINK'			=> 'Jouw doorverwijs link',
	'YOUR_STATISTICS'		=> 'Jouw statistieken',
	'MEMBERS_REFERRED'		=> 'Doorverwezen leden',
	'INVITATIONS_SENT'		=> 'Uitnodigingen verzonden',
	'CONTESTS_WON'			=> 'Wedstrijd gewonnen',
	'RECIPIENTS'		 	=> 'Ontvanger(s)',
	'RECIPIENTS_EXPLAIN' 	=> 'Je kan uitnodigingen zenden naar meerdere ontvangers door ieder mail adres op een nieuw lijn te plaatsen.',
	'SENDER_EMAIL'			=> 'Jouw email',
	'MESSAGE_EXPLAIN'		=> 'Je doorverwijzing link zal automatisch toegevoegd worden aan het einde van je bericht.',
	'INVITATION_SENT'		=> 'Je uitnodiging werd succesvol verzonden!',
	'FORM_ERROR'		 	=> 'Je moet alle velden invullen.',
	'YOUR_REFERRALS'	 	=> 'Jouw doorverwijzingen',
	'NO_REFERRALS'			=> 'Je hebt nog geen doorverwijzers.',
));
