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
	'GENERAL_CONFIG'					=> 'Paramètres Généraux',
	'DISPLAY_TOP_FIVE_REFERRERS'		=> 'Afficher le Top 5 des parrains/référents sur l\'index du forum',
	'DISPLAY_USER_REFERRALS_VIEWTOPIC' 	=> 'Afficher le compteur du parrainage de l\'utilisateur dans la vue du sujet',
	'DISPLAY_USER_REFERRALS_PROFILE'	=> 'Afficher le compteur du parrainage de l\'utilisateur dans le profil',
	'DISPLAY_REFERRAL_CONTESTS'			=> 'Afficher le resultat du concours de référencement sur l\'index du forum',
	'CONTEST_ADD'						=> 'Ajouter un Concours',
	'CONTEST_NAME'					 	=> 'Nom du Concours',
	'CONTEST_DESCRIPTION'				=> 'Description',
	'REFERRAL_MINIMUM_POSTS'			=> 'Minimum de posts pour le référencement',
	'REFERRAL_MINIMUM_POSTS_EXPLAIN'	=> 'Définissez le nombre de messages minimum d\'un nouvel utilisateur, pour être validé comme filleul (référencé).',
	'CONTEST_DURATION'				 	=> 'Durée',
	'DAYS'							 	=> 'Jours',
	'WEEKS'								=> 'Semaines',
	'MONTHS'							=> 'Mois',
	'CONTEST_START_DATE'				=> 'Date de départ',
	'CONTEST_END_DATE'				 	=> 'Date de fin',
	'CONTEST_STATUS'					=> 'Status',
	'CONTEST_IN_PROGRESS'				=> 'En cours',
	'CONTEST_OVER'					 	=> 'Terminé',
	'LIST_CONTEST'					 	=> 'Concours',
	'LIST_CONTESTS'						=> 'Concours',
	'NO_CONTESTS'						=> 'Pas de concours en cours.',
	'ENTER_CONTEST_NAME'				=> 'Vous n\'avez pas spécifier de nom pour votre concours.',
	'CONTEST_INFO_UPDATED'			 	=> 'Concours mis à jour avec succés.',
	'CONTEST_ADDED'						=> 'Concours crée avec succés.',
	'CONTEST_DELETED'					=> 'Concours supprimé avec succés.',
	'VIEW_STATISTICS'					=> 'Voir les statistiques',
	'CONTEST_POS'						=> 'Position',
	'REFERRER_USERNAME'					=> 'Nom du Référent',
	'REFERRAL_USERNAME'					=> 'Référencé',
	'CONTEST_TOTAL_REFERRALS'			=> 'Total de membres référencé durant ce concours',
	'NO_STATS'						 	=> 'Il n\'y a pas de statistiques disponibles pour ce concours.',
	'SEARCH_REFERRER'					=> 'Recherche de référents',
	'REFERRALS'							=> 'Référencés',
	'LIST_REFERRER'						=> 'Référent',
	'LIST_REFERRERS'					=> 'Référents',
	'VIEW_REFERRALS'					=> 'Voir les référencés',
	'REFERRER'						 	=> 'Référent',
	'REFERRED_ON'						=> 'Rérencé par',
	'REFERRER_NOT_FOUND'				=> 'Le référent que vous recherchez n\'a pu être trouvé.',
	'NO_REFERRERS'					 	=> 'Il n\'y a pas de référents pour l\'instant.',
));
