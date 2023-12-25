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
	'ACP_MOD_VERSION'					=> 'Version',
	'GENERAL_CONFIG'					=> 'Allgemeine Einstellungen',
	'DISPLAY_TOP_FIVE_REFERRERS'		=> 'Zeige die Top 5 der Verweiser im Boardindex',
	'DISPLAY_USER_REFERRALS_VIEWTOPIC'	=> 'Zeige den Zähler für Benutzerverweise in Themenansicht',
	'DISPLAY_USER_REFERRALS_PROFILE'	=> 'Zeige den Zähler für Benutzerverweise im Profil',
	'DISPLAY_REFERRAL_CONTESTS'			=> 'Zeige Verweis-Wettbewerbe im Boardindex',
	'CONTEST_ADD'						=> 'Wettbewerb hinzufügen',
	'CONTEST_NAME'					 	=> 'Wettbewerbsname',
	'CONTEST_DESCRIPTION'				=> 'Beschreibung',
	'REFERRAL_MINIMUM_POSTS'			=> 'Mindestbeiträge Verweis',
	'REFERRAL_MINIMUM_POSTS_EXPLAIN'	=> 'Stelle die Mindestbeiträge ein, die ein Verweis haben muss, um als gültiger Verweis zu zählen.',
	'CONTEST_DURATION'				 	=> 'Dauer',
	'DAYS'							 	=> 'Tage',
	'WEEKS'								=> 'Wochen',
	'MONTHS'							=> 'Monate',
	'CONTEST_START_DATE'				=> 'Startdatum',
	'CONTEST_END_DATE'				 	=> 'Enddatum',
	'CONTEST_STATUS'					=> 'Status',
	'CONTEST_IN_PROGRESS'				=> 'In Bearbeitung',
	'CONTEST_OVER'					 	=> 'Über',
	'LIST_CONTEST'					 	=> 'Wettbewerb',
	'LIST_CONTESTS'						=> 'Wettbewerbe',
	'NO_CONTESTS'						=> 'Kein Wettbewerb gefunden.',
	'ENTER_CONTEST_NAME'				=> 'Du musst einen Namen für den Wettbewerb eingeben.',
	'CONTEST_INFO_UPDATED'			 	=> 'Der Wettbewerb wurde erfolgreich aktualisiert.',
	'CONTEST_ADDED'						=> 'Der Wettbewerb wurde erfolgreich erstellt.',
	'CONTEST_DELETED'					=> 'Der Wettbewerb wurde erfolgreich gelöscht.',
	'VIEW_STATISTICS'					=> 'Statistiken ansehen',
	'CONTEST_POS'						=> 'Pos',
	'REFERRER_USERNAME'					=> 'Benutzername Verweiser',
	'REFERRAL_USERNAME'					=> 'Benutzername Verweis',
	'CONTEST_TOTAL_REFERRALS'			=> 'Mitglieder insgesamt verwiesen durch diesen Wettbewerb',
	'NO_STATS'						 	=> 'Für diesen Wettbewerb gibt es keine Statistiken.',
	'SEARCH_REFERRER'					=> 'Suche nach einem Verweiser',
	'REFERRALS'							=> 'Verweise',
	'LIST_REFERRER'						=> 'Verweiser',
	'LIST_REFERRERS'					=> 'Verweiser',
	'VIEW_REFERRALS'					=> 'Verweise ansehen',
	'REFERRER'						 	=> 'Verweiser',
	'REFERRED_ON'						=> 'Verwiesen auf',
	'REFERRER_NOT_FOUND'				=> 'Der Verweiser, nach dem du suchst, konnte nicht gefunden werden.',
	'NO_REFERRERS'					 	=> 'Es gibt bisher keine Verweiser.',
));
