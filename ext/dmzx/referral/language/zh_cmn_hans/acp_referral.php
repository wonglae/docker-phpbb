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
	'ACP_MOD_VERSION'					=> '版本',
	'GENERAL_CONFIG'					=> '常规设置',
	'DISPLAY_TOP_FIVE_REFERRERS'		=> '在论坛首页显示前五名推荐人',
	'DISPLAY_USER_REFERRALS_VIEWTOPIC'	=> '在主题查看中显示用户推荐数',
	'DISPLAY_USER_REFERRALS_PROFILE'	=> '在个人资料中显示用户推荐数',
	'DISPLAY_REFERRAL_CONTESTS'			=> '在论坛首页显示推荐竞赛',
	'CONTEST_ADD'						=> '添加竞赛',
	'CONTEST_NAME'					 	=> '竞赛名称',
	'CONTEST_DESCRIPTION'				=> '描述',
	'REFERRAL_MINIMUM_POSTS'			=> '推荐最低发帖数',
	'REFERRAL_MINIMUM_POSTS_EXPLAIN'	=> '设置推荐人需要拥有的最低发帖数才能被计为有效推荐。',
	'CONTEST_DURATION'				 	=> '持续时间',
	'DAYS'							 	=> '天',
	'WEEKS'								=> '周',
	'MONTHS'							=> '月',
	'CONTEST_START_DATE'				=> '开始日期',
	'CONTEST_END_DATE'				 	=> '结束日期',
	'CONTEST_STATUS'					=> '状态',
	'CONTEST_IN_PROGRESS'				=> '进行中',
	'CONTEST_OVER'					 	=> '结束',
	'LIST_CONTEST'					 	=> '竞赛',
	'LIST_CONTESTS'						=> '竞赛',
	'NO_CONTESTS'						=> '没有找到竞赛。',
	'ENTER_CONTEST_NAME'				=> '您必须为竞赛指定一个名称。',
	'CONTEST_INFO_UPDATED'			 	=> '竞赛已成功更新。',
	'CONTEST_ADDED'						=> '竞赛已成功创建。',
	'CONTEST_DELETED'					=> '竞赛已成功删除。',
	'VIEW_STATISTICS'					=> '查看统计',
	'CONTEST_POS'						=> '排名',
	'REFERRER_USERNAME'					=> '推荐人用户名',
	'REFERRAL_USERNAME'					=> '被推荐人用户名',
	'CONTEST_TOTAL_REFERRALS'			=> '本次竞赛期间推荐的总会员数',
	'NO_STATS'						 	=> '本次竞赛没有可用的统计数据。',
	'SEARCH_REFERRER'					=> '搜索推荐人',
	'REFERRALS'							=> '推荐',
	'LIST_REFERRER'						=> '推荐人',
	'LIST_REFERRERS'					=> '推荐人',
	'VIEW_REFERRALS'					=> '查看推荐',
	'REFERRER'						 	=> '推荐人',
	'REFERRED_ON'						=> '推荐时间',
	'REFERRER_NOT_FOUND'				=> '您要找的推荐人不存在。',
	'NO_REFERRERS'					 	=> '还没有推荐人。'
));
