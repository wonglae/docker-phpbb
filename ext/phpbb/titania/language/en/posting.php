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
	'ACCESS'							=> 'Access Level',
	'ACCESS_AUTHORS'					=> 'Authors Access',
	'ACCESS_PUBLIC'						=> 'Public Access',
	'ACCESS_TEAMS'						=> 'Teams Access',
	'ATTACH'							=> 'Attach',

	'ERROR_MERGE_SAME_TOPIC'			=> 'The destination topic and source topic are the same.',
	'ERROR_NOT_SAME_PARENT'				=> 'You may only move posts to a topic that resides in the same contribution.',

	'FILE_DELETED'						=> 'This file will be deleted when you submit',

	'HARD_DELETE_TOPIC_CONFIRM'			=> 'Are you sure you want to <strong>hard</strong> delete this topic?<br /><br />This topic will be gone forever!',

	'QUEUE_DISCUSSION_TOPIC_MESSAGE'	=> 'This topic is for validation discussion between the contribution authors and validators.

Anything posted in this topic will be read by those validating your contribution so please post here instead of using private messages to validators.

Validation staff may also post questions to the authors here so please reply with helpful information for them as it may be required to proceed with the validation procedure.

Note that by default this topic is private between authors and validators and cannot be seen by the public.',
	'QUEUE_DISCUSSION_TOPIC_TITLE'		=> 'Validation Discussion - %s',
	'QUOTE'								=> 'Quote',

	'REPORT_POST_CONFIRM'				=> 'Use this form to report the selected post to the forum moderators and board administrators. Reporting should generally be used only if the post breaks forum rules.',

	'SET_PREVIEW_FILE'					=> 'Set as preview',
	'SOFT_DELETE_TOPIC_CONFIRM'			=> 'Are you sure you want to <strong>soft</strong> delete this topic?',
	'SPLIT_NOT_ALLOWED'					=> 'You are not allowed to split this topic.',
	'STICKIES'							=> 'Stickies',
	'STICKY_TOPIC'						=> 'Sticky Topic',

	'UNDELETE_FILE'						=> 'Cancel Delete',
	'UNDELETE_POST'						=> 'Undelete Post',
	'UNDELETE_POST_CONFIRM'				=> 'Are you sure you want to undelete this post?',
	'UNDELETE_TOPIC_CONFIRM'			=> 'Are you sure you want to undelete this topic?',
));
