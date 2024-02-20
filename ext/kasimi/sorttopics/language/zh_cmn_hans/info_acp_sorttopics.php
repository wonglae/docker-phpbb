<?php

/**
 *
 * @package phpBB Extension - Sort Topics
 * @copyright (c) 2016 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'SORTTOPICS_TITLE' => '对主题进行排序',
	'SORTTOPICS_CONFIG' => '配置',
	'SORTTOPICS_CONFIG_UPDATED' => '<strong>Sort Topics</strong> 扩展<br />» 配置已更新',
	'SORTTOPICS_UCP_ENABLED' => '允许用户全局按创建时间排序主题',
	'SORTTOPICS_UCP_ENABLED_EXPLAIN' => '在用户控制面板中为用户提供按创建时间在所有论坛中排序主题的选项',
	'SORTTOPICS_SORT_TOPICS_BY' => '按以下方式排序主题',
	'SORTTOPICS_SORT_TOPICS_BY_EXPLAIN' => '除“用户默认”外的任何值都会强制该论坛中的主题按指定的键进行初始排序，忽略用户在用户控制面板中的排序偏好。用户仍然可以在每个 viewforum 页面底部临时更改排序方式',
	'SORTTOPICS_SORT_TOPICS_ORDER' => '主题排序顺序',
	'SORTTOPICS_SORT_TOPICS_ORDER_EXPLAIN' => '仅在上述选项设置为“用户默认”之外的值时有效',
	'SORTTOPICS_APPLY_TO_SUBFORUMS' => '将此论坛的主题排序应用于所有子论坛',
	'SORTTOPICS_APPLY_TO_SUBFORUMS_EXPLAIN' => '如果设置为“是”，则将应用上述排序首选项到此论坛和所有子论坛（以及它们的子论坛）',
	'SORTTOPICS_USER_DEFAULT' => '用户默认',
));
