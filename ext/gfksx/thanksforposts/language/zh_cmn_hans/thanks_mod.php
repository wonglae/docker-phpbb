<?php
/**
 *
 * Thanks For Posts.
 * Adds the ability to thank the author and to use per posts/topics/forum rating system based on the count of thanks.
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2020, rxu, https://www.phpbbguru.net
 * @license GNU General Public License, version 2 (GPL-2.0)
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
	$lang = [];
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
// ' » “ ” …
//

$lang = array_merge($lang, [
	'CLEAR_LIST_THANKS'								=> '清除点赞列表',
	'CLEAR_LIST_THANKS_CONFIRM'				=> '清除用户的点赞列表吗？',
	'CLEAR_LIST_THANKS_GIVE'					=> '用户发出的点赞清单已被清除。',
	'CLEAR_LIST_THANKS_POST'					=> '消息中的点赞清单已被清除。',
	'CLEAR_LIST_THANKS_RECEIVE'				=> '用户获得的点赞清单已被清除。',

	'DISABLE_REMOVE_THANKS'						=> '管理员已禁用删除点赞。',

	'CHECKINS'												=> '签到天数',
	'CHECKIN_DAYS'										=> [
		1																=> '%d天',
		2																=> '%d天',
	],

	'GIVEN'														=> '已发点赞',
	'GLOBAL_INCORRECT_THANKS'					=> '您不能为没有指定特定论坛的全局公告表示点赞。',
	'GRATITUDES'											=> '点赞列表',

	'INCORRECT_THANKS'								=> '无效的点赞',

	'JUMP_TO_FORUM'										=> '跳转到论坛',
	'JUMP_TO_TOPIC'										=> '跳转到主题',

	'FOR_MESSAGE'											=> '的帖子',
	'FURTHER_THANKS'									=> [
		1																=> '还有一个用户',
		2																=> '还有%d个用户',
	],

	'NO_VIEW_USERS_THANKS'						=> '您无权查看点赞列表。',

	'NOTIFICATION_THANKS_GIVE'				=> [
		1																=> '%1$s <strong>点赞了</strong> 您的帖子：',
		2																=> '%1$s <strong>点赞了</strong> 您的帖子：',
	],
	'NOTIFICATION_THANKS_REMOVE'			=> [
		1																=> '%1$s <strong>取消了</strong> 对您帖子的点赞：',
		2																=> '%1$s <strong>取消了</strong> 对您帖子的点赞：',
	],
	'NOTIFICATION_TYPE_THANKS_GIVE'		=> '有人点赞您的帖子',
	'NOTIFICATION_TYPE_THANKS_REMOVE'	=> '有人取消了对您帖子的点赞',

	'RECEIVED'												=> '已收点赞',
	'REMOVE_THANKS'										=> '删除您的点赞：',
	'REMOVE_THANKS_CONFIRM'						=> '您确定要删除您的点赞吗？',
	'REMOVE_THANKS_SHORT'							=> '删除点赞',
	'REPUT'														=> '评级',
	'REPUT_TOPLIST'										=> '点赞排行榜 - %d',
	'RATING_LOGIN_EXPLAIN'						=> '您无权查看排行榜。',
	'RATING_NO_VIEW_TOPLIST'					=> '您无权查看排行榜。',
	'RATING_VIEW_TOPLIST_NO'					=> '排行榜为空或已被管理员禁用',
	'RATING_FORUM'										=> '论坛',
	'RATING_POST'											=> '帖子',
	'RATING_TOP_FORUM'								=> '论坛评级',
	'RATING_TOP_POST'									=> '帖子评级',
	'RATING_TOP_TOPIC'								=> '主题评级',
	'RATING_TOPIC'										=> '主题',

	'THANK'														=> '次',
	'THANK_FROM'											=> '来自',
	'THANK_TEXT_1'										=> '这些用户点赞了作者',
	'THANK_TEXT_2'										=> '的帖子：',
	'THANK_TEXT_2PL'									=> '的帖子（共%d）：',
	'THANK_POST'											=> '点赞帖子作者：',
	'THANK_POST_SHORT'								=> '点赞',
	'THANKS'													=> [
		1																=> '%d 次',
		2																=> '%d 次',
	],
	'THANKS_BACK'											=> '返回',
	'THANKS_INFO_GIVE'								=> '您刚刚点赞了该帖子。',
	'THANKS_INFO_REMOVE'							=> '您刚刚删除了您的点赞。',
	'THANKS_LIST'											=> '查看/关闭列表',
	'THANKS_PM_MES_GIVE'							=> '点赞您的帖子',
	'THANKS_PM_MES_REMOVE'						=> '已删除您对该帖子的点赞',
	'THANKS_PM_SUBJECT_GIVE'					=> '点赞您的帖子',
	'THANKS_PM_SUBJECT_REMOVE'				=> '已删除您对该帖子的点赞',
	'THANKS_USER'											=> '点赞列表',
	'TOPLIST'													=> '帖子排行榜',
	'TOOLTIP_THANKS_REPLY' 						=> '点赞作者并且回复帖子',
	'BUTTON_THANKS_REPLY'							=> '点赞并回复',
]);
