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
	'GENERAL_CONFIG'					=> 'General settings',
	'DISPLAY_TOP_FIVE_REFERRERS'		=> 'Display top 5 referrers on board index',
	'DISPLAY_USER_REFERRALS_VIEWTOPIC'	=> 'Display user referrals count in viewtopic',
	'DISPLAY_USER_REFERRALS_PROFILE'	=> 'Display user referrals count in profile',
	'DISPLAY_REFERRAL_CONTESTS'			=> 'Display referral contests on board index',
	'CONTEST_ADD'						=> 'Add contest',
	'CONTEST_NAME'					 	=> 'Contest name',
	'CONTEST_DESCRIPTION'				=> 'Description',
	'REFERRAL_MINIMUM_POSTS'			=> 'Referral minimum posts',
	'REFERRAL_MINIMUM_POSTS_EXPLAIN'	=> 'Set the minimum posts a referrer needs to have in order to count as a valid referral.',
	'CONTEST_DURATION'				 	=> 'Duration',
	'DAYS'							 	=> 'Days',
	'WEEKS'								=> 'Weeks',
	'MONTHS'							=> 'Months',
	'CONTEST_START_DATE'				=> 'Start date',
	'CONTEST_END_DATE'				 	=> 'End date',
	'CONTEST_STATUS'					=> 'Status',
	'CONTEST_IN_PROGRESS'				=> 'In progress',
	'CONTEST_OVER'					 	=> 'Over',
	'LIST_CONTEST'					 	=> 'Contest',
	'LIST_CONTESTS'						=> 'Contests',
	'NO_CONTESTS'						=> 'No contests found.',
	'ENTER_CONTEST_NAME'				=> 'You have to specify a name for the contest.',
	'CONTEST_INFO_UPDATED'			 	=> 'Contest has been successfully updated.',
	'CONTEST_ADDED'						=> 'Contest has been successfully created.',
	'CONTEST_DELETED'					=> 'Contest has been successfully deleted.',
	'VIEW_STATISTICS'					=> 'View statistics',
	'CONTEST_POS'						=> 'Pos',
	'REFERRER_USERNAME'					=> 'Referrer username',
	'REFERRAL_USERNAME'					=> 'Referral username',
	'CONTEST_TOTAL_REFERRALS'			=> 'Total members referred during this contest',
	'NO_STATS'						 	=> 'There are no statistics available for this contest.',
	'SEARCH_REFERRER'					=> 'Search for a referrer',
	'REFERRALS'							=> 'Referrals',
	'LIST_REFERRER'						=> 'Referrer',
	'LIST_REFERRERS'					=> 'Referrers',
	'VIEW_REFERRALS'					=> 'View referrals',
	'REFERRER'						 	=> 'Referrer',
	'REFERRED_ON'						=> 'Referred on',
	'REFERRER_NOT_FOUND'				=> 'The referrer you are looking for could not be found.',
	'NO_REFERRERS'					 	=> 'There are no referrers yet.',
));
