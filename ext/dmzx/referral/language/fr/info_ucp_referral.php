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
	'UCP_REFERRAL'			=> 'Parrainage/Invitez vos amis',
	'UCP_STATISTICS'	 	=> 'Voir les statistiques',
	'UCP_REFERRALS'			=> 'Voir les parrains/référents',
	'UCP_INVITE'		 	=> 'Inviter un ami',
	'REFERRAL_LINK'			=> 'Votre lien de parrainage/référencement',
	'YOUR_STATISTICS'		=> 'Vos statistiques',
	'MEMBERS_REFERRED'		=> 'Membres parrainés',
	'INVITATIONS_SENT'		=> 'Invitations envoyées',
	'CONTESTS_WON'			=> 'Concours gagnés',
	'RECIPIENTS'		 	=> 'Bénéficiaire(s)',
	'RECIPIENTS_EXPLAIN' 	=> 'Vous pouvez envoyer une invitation à plusieurs destinataires en entrant chaque adresse e-mail sur une nouvelle ligne.',
	'SENDER_EMAIL'			=> 'Votre email',
	'MESSAGE_EXPLAIN'		=> 'Votre lien de parrainage sera inséré automatiquement à la fin de votre message.',
	'INVITATION_SENT'		=> 'Votre invitation a été envoyée avec succès!',
	'FORM_ERROR'		 	=> 'Vous devez remplir tous les champs.',
	'YOUR_REFERRALS'	 	=> 'Vos filleuls',
	'NO_REFERRALS'			=> 'Vous n\'avez pas encore de filleul(s).',
));
