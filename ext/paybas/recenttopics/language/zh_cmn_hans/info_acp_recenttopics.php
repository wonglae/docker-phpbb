<?php
/**
 *
 * @package Recent Topics Extension
 * English translation by PayBas
 *
 * @copyright (c) 2015 PayBas
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 * Based on the original NV Recent Topics by Joas Schilling (nickvergessen)
 */

if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge(
	$lang, array(
	//forum acp
	'RECENT_TOPICS_LIST'            => '在“最新的主题”上显示',
	'RECENT_TOPICS_LIST_EXPLAIN'    => '启用在“最新的主题”扩展中显示此论坛中的主题。',

	//acp title
	'RECENT_TOPICS'                 => '最新的话题',
	'RT_CONFIG'                     => '配置',
	'RECENT_TOPICS_EXPLAIN'         => '在此页面上，您可以更改特定于最近主题扩展的设置。<br /><br />可以通过编辑ACP中的相应论坛来包括或排除特定论坛。<br />还要确保检查您的用户权限，以允许用户为自己更改下面找到的某些设置。',

	//global settings
	'RT_GLOBAL_SETTINGS'            => '全局设置',
	'RT_DISPLAY_INDEX'              => '在首页上显示',
	'RT_NUMBER'                     => '显示最近话题的数量',
	'RT_NUMBER_EXP'                 => '每页显示的最大主题数。',
	'RT_PAGE_NUMBER'                => '显示所有最近话题页面',
	'RT_PAGE_NUMBER_EXP'            => '此功能覆盖设置的最大页面数，并显示所有页面，无论选项设置了多少页。',
	'RT_PAGE_NUMBERMAX'             => '最大页面数',
	'RT_PAGE_NUMBERMAX_EXP'         => '将页面最大值设置为在最近话题分页中显示，除非被覆盖。',
	'RT_MIN_TOPIC_LEVEL'            => '最小主题类型级别',
	'RT_MIN_TOPIC_LEVEL_EXP'        => '确定要显示的主题类型的最小级别。它只会显示设置级别及更高级别的主题。',
	'RT_ANTI_TOPICS'                => '排除的主题ID',
	'RT_ANTI_TOPICS_EXP'            => '要排除的主题ID，用“，”分隔（例如：7,9）<br />值0禁用此行为。',
	'RT_PARENTS'                    => '显示父论坛',
	'RT_PARENTS_EXP'                => '在最近话题的主题行内显示父论坛。',

	//User Overridable settings. these apply for anon users and can be overridden by UCP
	'RT_OVERRIDABLE'                => 'UCP可覆盖设置',
	'RT_LOCATION'                   => '显示位置',
	'RT_LOCATION_EXP'               => '选择要显示最近话题的位置。',
	'RT_TOP'                        => '顶部显示',
	'RT_BOTTOM'                     => '底部显示',
	'RT_SIDE'                       => '侧边栏显示',
	'RT_SORT_START_TIME'            => '按主题开始时间排序',
	'RT_SORT_START_TIME_EXP'        => '启用按主题开始时间排序最近话题，而不是按最后发布时间排序。',
	'RT_UNREAD_ONLY'                => '仅显示未读主题',
	'RT_UNREAD_ONLY_EXP'            => '启用仅显示未读主题（无论它们是否“最近”）。此功能使用与正常模式相同的设置（排除论坛/主题等）。注意：这仅适用于已登录用户；访客将获得正常列表。',
	'RT_RESET_DEFAULT'              => '重置用户设置',
	'RT_RESET_DEFAULT_EXP'          => '将用户设置重置为默认值。',

	//Enable for extensions
	'RT_NICKVERGESSEN_NEWSPAGE'     => '新闻页面扩展支持',
	'RT_VIEW_ON'                    => '在以下位置上显示最新话题：',

	//Donation
	'RT_DONATE_URL'             		=> 'http://www.avathar.be/forum/app.php/page/donate',
	'PAYPAL_IMAGE_URL'          		=> 'https://www.paypalobjects.com/webstatic/en_US/i/btn/png/silver-pill-paypal-26px.png',
	'PAYPAL_ALT'                		=> '使用PayPal捐赠',
	'RT_DONATE'											=> '捐赠给RecentTopics',
	'RT_DONATE_SHORT'								=> '向RecentTopics捐款',
	'RT_DONATE_EXPLAIN'							=> 'RecentTopics是100％免费的。这是我花费时间和金钱进行的业余项目，仅仅是为了好玩。如果您喜欢使用RecentTopics，请考虑捐款。我会非常感激。没有任何附加条件。',
	)
);
