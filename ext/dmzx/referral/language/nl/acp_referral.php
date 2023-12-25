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
	'ACP_MOD_VERSION'					=> 'Versie',
	'GENERAL_CONFIG'					=> 'Algemene instellingen',
	'DISPLAY_TOP_FIVE_REFERRERS'		=> 'Toon top 5 doorverwijzers op de index',
	'DISPLAY_USER_REFERRALS_VIEWTOPIC'	=> 'Toon gebruikers doorverwijzingen in viewtopic',
	'DISPLAY_USER_REFERRALS_PROFILE'	=> 'Toon gebruikers doorverwijzing teller in profiel',
	'DISPLAY_REFERRAL_CONTESTS'			=> 'Toon doorverwijzing wedstrijd op de forum index',
	'CONTEST_ADD'						=> 'Voeg wedstrijd toe',
	'CONTEST_NAME'					 	=> 'Wedstrijd naam',
	'CONTEST_DESCRIPTION'				=> 'Beschrijving',
	'REFERRAL_MINIMUM_POSTS'			=> 'Doorverwijzer min posten',
	'REFERRAL_MINIMUM_POSTS_EXPLAIN'	=> 'Stel het minimum posten in dat een doorverwijzer nodig heeft om te tellen als een geldige doorverwijzer.',
	'CONTEST_DURATION'				 	=> 'Duur',
	'DAYS'							 	=> 'Dagen',
	'WEEKS'								=> 'Weken',
	'MONTHS'							=> 'Maanden',
	'CONTEST_START_DATE'				=> 'Start datum',
	'CONTEST_END_DATE'				 	=> 'Eind datum',
	'CONTEST_STATUS'					=> 'Status',
	'CONTEST_IN_PROGRESS'				=> 'Lopende',
	'CONTEST_OVER'					 	=> 'Over',
	'LIST_CONTEST'					 	=> 'Wedstrijd',
	'LIST_CONTESTS'						=> 'Wedstrijden',
	'NO_CONTESTS'						=> 'Geen wedstrijd gevonden.',
	'ENTER_CONTEST_NAME'				=> 'Je moet een naam opgeven voor de wedstrijd.',
	'CONTEST_INFO_UPDATED'			 	=> 'Wedstrijd werd succesvol geupdate.',
	'CONTEST_ADDED'						=> 'Wedstrijd werd succesvol aangemaakt.',
	'CONTEST_DELETED'					=> 'Wedstrijd werd succesvol verwijderd.',
	'VIEW_STATISTICS'					=> 'Bekijk statistieken',
	'CONTEST_POS'						=> 'Pos',
	'REFERRER_USERNAME'					=> 'Doorgewezen gebruikersnaam',
	'REFERRAL_USERNAME'					=> 'Doorverwijzer gebruikersnaam',
	'CONTEST_TOTAL_REFERRALS'			=> 'Totaal aantal leden doorgewezen gedurende deze wedstrijd',
	'NO_STATS'						 	=> 'Er zijn geen statistieken beschikbaar voor deze wedstrijd.',
	'SEARCH_REFERRER'					=> 'Zoek naar een doorverwijzer',
	'REFERRALS'							=> 'Doorverwijzers',
	'LIST_REFERRER'						=> 'Verwijzer',
	'LIST_REFERRERS'					=> 'Verwijzers',
	'VIEW_REFERRALS'					=> 'Bekijk verwijzers',
	'REFERRER'						 	=> 'Doorverwijzer',
	'REFERRED_ON'						=> 'Doorgewezen op',
	'REFERRER_NOT_FOUND'				=> 'De verwijzer die u zoekt kan niet worden gevonden.',
	'NO_REFERRERS'					 	=> 'Er zijn nog geen verwijzers.',
));
