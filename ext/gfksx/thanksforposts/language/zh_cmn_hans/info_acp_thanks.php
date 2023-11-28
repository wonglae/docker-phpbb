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

$lang = array_merge($lang, [
	'ACP_DELTHANKS' 											=> '删除记录的感谢',
	'ACP_POSTS' 													=> '总帖子数',
	'ACP_POSTSEND' 												=> '剩余带感谢的帖子',
	'ACP_POSTSTHANKS' 										=> '总感谢帖子数',
	'ACP_THANKS' 													=> '感谢帖子',
	'ACP_THANKS_MOD_VER' 									=> '扩展版本：',
	'ACP_THANKS_TRUNCATE' 								=> '清除感谢列表',
	'ACP_ALLTHANKS' 											=> '记录过的感谢',
	'ACP_THANKSEND' 											=> '剩余要记录的感谢',
	'ACP_THANKS_REPUT' 										=> '评级选项',
	'ACP_THANKS_REPUT_SETTINGS' 					=> '评级选项',
	'ACP_THANKS_REPUT_SETTINGS_EXPLAIN' 	=> '根据此处的感谢系统设置帖子、主题和论坛的默认评级设置。 <br /> 拥有最多感谢总数的主题（帖子、主题或论坛）将获得100%的评级。',
	'ACP_THANKS_SETTINGS' 								=> '感谢设置',
	'ACP_THANKS_SETTINGS_EXPLAIN' 				=> '可以在此处更改默认的帖子感谢设置。',
	'ACP_THANKS_REFRESH' 									=> '更新计数器',
	'ACP_UPDATETHANKS' 										=> '更新记录的感谢',
	'ACP_USERSEND' 												=> '剩余感谢的用户',
	'ACP_USERSTHANKS' 										=> '感谢的用户总数',

	'GRAPHIC_BLOCK_BACK'									=> 'ext/gfksx/thanksforposts/images/rating/reput_block_back.gif',
	'GRAPHIC_BLOCK_RED'										=> 'ext/gfksx/thanksforposts/images/rating/reput_block_red.gif',
	'GRAPHIC_DEFAULT'											=> '图像',
	'GRAPHIC_OPTIONS'											=> '图形选项',
	'GRAPHIC_STAR_BACK'										=> 'ext/gfksx/thanksforposts/images/rating/reput_star_back.gif',
	'GRAPHIC_STAR_BLUE'										=> 'ext/gfksx/thanksforposts/images/rating/reput_star_blue.gif',
	'GRAPHIC_STAR_GOLD'										=> 'ext/gfksx/thanksforposts/images/rating/reput_star_gold.gif',

	'IMG_THANKPOSTS'											=> '感谢帖子',
	'IMG_REMOVETHANKS'										=> '取消感谢',

	'LOG_CONFIG_THANKS'										=> '更新感谢帖子扩展的配置',

	'REFRESH'															=> '刷新',
	'REMOVE_THANKS' 											=> '删除感谢',
	'REMOVE_THANKS_EXPLAIN' 							=> '如果启用此选项，用户可以删除感谢。',

	'STEPR'																=> ' - 执行，步骤 %s',

	'THANKS_COUNTERS_VIEW'								=> '感谢计数器',
	'THANKS_COUNTERS_VIEW_EXPLAIN'				=> '如果启用，有关作者的块信息将显示已发出/已收到的感谢数量。',
	'THANKS_FORUM_REPUT_VIEW'							=> '显示论坛评级',
	'THANKS_GLOBAL_POST'									=> '全局公告中的感谢',
	'THANKS_GLOBAL_POST_EXPLAIN'					=> '如果启用，则启用全局公告中的感谢。',
	'THANKS_FORUM_REPUT_VIEW_EXPLAIN'			=> '如果启用，论坛评级将显示在论坛列表中。',
	'THANKS_INFO_PAGE'										=> '信息性消息',
	'THANKS_INFO_PAGE_EXPLAIN'						=> '如果启用，将在感谢/删除感谢帖子后显示信息性消息。',
	'THANKS_NOTICE_ON'										=> '通知可用',
	'THANKS_NOTICE_ON_EXPLAIN'						=> '如果启用，则通知可用，用户可以通过您的个人资料配置通知。',
	'THANKS_NUMBER'												=> '在个人资料中显示的感谢列表中的感谢者数量',
	'THANKS_NUMBER_EXPLAIN'								=> '查看个人资料时显示的感谢的最大数量。 <br /> <strong>请记住，如果将此值设置为超过250，则会注意到减速。</strong>',
	'THANKS_NUMBER_DIGITS'								=> '评级的小数位数',
	'THANKS_NUMBER_DIGITS_EXPLAIN'				=> '指定评级值的小数位数。',
	'THANKS_NUMBER_ROW_REPUT'							=> '评级排行榜中的行数',
	'THANKS_NUMBER_ROW_REPUT_EXPLAIN'			=> '指定要在帖子、主题和论坛评级排行榜中显示的行数。',
	'THANKS_NUMBER_POST'									=> '在帖子中列出的感谢者数量',
	'THANKS_NUMBER_POST_EXPLAIN'					=> '查看帖子时显示的感谢者的最大数量。 <br /> <strong>请记住，如果将此值设置为超过250，则会注意到减速。</strong>',
	'THANKS_ONLY_FIRST_POST' 							=> '仅适用于主题中的第一篇帖子',
	'THANKS_ONLY_FIRST_POST_EXPLAIN' 			=> '如果启用，则用户只能感谢主题中的第一篇帖子。',
	'THANKS_POST_REPUT_VIEW' 							=> '显示帖子评级',
	'THANKS_POST_REPUT_VIEW_EXPLAIN' 			=> '如果启用，则在查看主题时将显示帖子评级。',
	'THANKS_POSTLIST_VIEW' 								=> '在帖子中列出感谢',
	'THANKS_POSTLIST_VIEW_EXPLAIN' 				=> '如果启用，则将显示感谢作者帖子的用户列表。<br/> 请注意，仅当管理员在该论坛中启用了感谢帖子的权限时，此选项才有效。',
	'THANKS_PROFILELIST_VIEW' 						=> '在个人资料中列出感谢',
	'THANKS_PROFILELIST_VIEW_EXPLAIN' 		=> '如果启用，则将显示感谢列表，包括感谢次数以及用户被感谢的帖子。',
	'THANKS_REFRESH' 											=> '更新感谢计数器',
	'THANKS_REFRESH_EXPLAIN' 							=> '在此处，您可以在批量删除帖子/主题/用户、拆分/合并主题、设置/删除全局公告、启用/禁用“仅适用于主题中的第一篇帖子”选项、更改帖子所有者等后更新感谢计数器。这可能需要一些时间。<br /><strong>重要提示：为了正确工作，刷新计数器函数需要MySQL 4.1或更高版本！<br />注意！<br />-刷新将删除所有来宾帖子的感谢！<br />-如果“全局公告中的感谢”选项关闭，则刷新将删除所有全局公告的感谢！<br />-如果“仅适用于主题中的第一篇帖子”选项打开，则刷新将删除除主题中的第一篇帖子以外的所有帖子的感谢！</strong>',
	'THANKS_REFRESH_MSG' 									=> '这可能需要几分钟才能完成。所有不正确的感谢条目都将被删除！<br />操作不可逆！',
	'THANKS_REFRESHED_MSG' 								=> '计数器已更新',
	'THANKS_REPUT_GRAPHIC' 								=> '评级的图形显示',
	'THANKS_REPUT_GRAPHIC_EXPLAIN' 				=> '如果启用，则评级值将使用下面的图像以图形方式显示。',
	'THANKS_REPUT_HEIGHT' 								=> '图形高度',
	'THANKS_REPUT_HEIGHT_EXPLAIN' 				=> '指定用于排名的滑块的高度（以像素为单位）。<br /> <strong>注意！为了正确显示，您应该指示与以下图像相同的高度！</strong>',
	'THANKS_REPUT_IMAGE' 									=> '滑块的主要图像',
	'THANKS_REPUT_IMAGE_DEFAULT' 					=> '<strong>图形预览</strong>',
	'THANKS_REPUT_IMAGE_DEFAULT_EXPLAIN' 	=> '可以在此处查看图像本身和图像的路径。图像大小为15x15像素。<br />您可以为前景和背景绘制自己的图像。<strong>图像的高度和宽度应相同，以确保正确构建图形比例尺。</strong>',
	'THANKS_REPUT_IMAGE_EXPLAIN' 					=> '相对于phpBB的根文件夹的路径-到图形比例尺图像。',
	'THANKS_REPUT_IMAGE_NOEXIST' 					=> '未找到滑块的主要图像。',
	'THANKS_REPUT_IMAGE_BACK' 						=> '滑块的背景图像',
	'THANKS_REPUT_IMAGE_BACK_EXPLAIN' 		=> '相对于phpBB安装文件夹的根目录的路径-到图形比例尺背景图像。',
	'THANKS_REPUT_IMAGE_BACK_NOEXIST' 		=> '未找到滑块的背景图像。',
	'THANKS_REPUT_LEVEL' 									=> '图形比例尺中的图像数',
	'THANKS_REPUT_LEVEL_EXPLAIN' 					=> '对应于图形中评级比例尺值100%的最大图像数。',
	'THANKS_TIME_VIEW' 										=> '感谢时间',
	'THANKS_TIME_VIEW_EXPLAIN' 						=> '如果启用，则帖子将显示感谢时间。',
	'THANKS_TOP_NUMBER' 									=> '排行榜中的用户数',
	'THANKS_TOP_NUMBER_EXPLAIN' 					=> '指定要在索引上显示的用户数。0-关闭显示排行榜。',
	'THANKS_TOPIC_REPUT_VIEW' 						=> '显示主题评级',
	'THANKS_TOPIC_REPUT_VIEW_EXPLAIN' 		=> '如果启用，则在查看论坛时将显示主题评级。',
	'TRUNCATE' 														=> '清除',
	'TRUNCATE_THANKS' 										=> '清除感谢列表',
	'TRUNCATE_THANKS_EXPLAIN' 						=> '此过程完全清除所有感谢计数器（删除所有已发出的感谢）。<br />此操作不可逆！',
	'TRUNCATE_THANKS_MSG' 								=> '感谢计数器已清除。',
	'REFRESH_THANKS_CONFIRM' 							=> '您真的要刷新感谢计数器吗？',
	'TRUNCATE_THANKS_CONFIRM' 						=> '您真的要清除感谢计数器吗？',
	'TRUNCATE_NO_THANKS' 									=> '操作已取消',
	'ALLOW_THANKS_PM_ON' 									=> '如果有人感谢我的帖子，请通知我PM',
	'ALLOW_THANKS_EMAIL_ON' 							=> '如果有人感谢我的帖子，请通知我电子邮件',
]);
