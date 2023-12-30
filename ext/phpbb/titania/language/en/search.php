<?php
/**
*
* This file is part of the phpBB Customisation Database package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
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

$lang = array_merge($lang, array(
	'CONTRIBUTION_NAME_DESCRIPTION'	=> 'Contribution Name/Description',
	'CONTRIB_FAQ'					=> 'Contribution FAQ',
	'CONTRIB_NAME_DESCRIPTION'		=> 'Contribution Name and Description',
	'CONTRIB_SUPPORT'				=> 'Contribution Discussion/Support',

	'NO_SEARCH_TERMS'				=> 'No search terms have been entered.',

	'SEARCH_KEYWORDS_EXPLAIN'		=> 'Put a list of words separated by <strong>|</strong> into brackets if only one of the words must be found. Use * as a wildcard for partial matches.',
	'SEARCH_MSG_ONLY'				=> 'Text/Description only',
	'SEARCH_SUBCATEGORIES'			=> 'Search Subcategories',
	'SEARCH_TITLE_MSG'				=> 'Titles and Text/Description',
	'SEARCH_TITLE_ONLY'				=> 'Titles only',
	'SEARCH_WITHIN_TYPES'			=> 'Search within types',
));
