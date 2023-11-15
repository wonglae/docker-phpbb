<?php
/**
*
* @package phpBB Extension - Advanced Active Topics
* @copyright (c) 2017 Galandas
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
// ' » “ ” …
//
$lang = array_merge($lang, array(
	'ACP_LAST_TOPIC'										=> '高级活跃主题',
	'ACP_LAST_TOPIC_EXPLAIN'						=> '扩展高级活跃主题由<a href="http://phpbb3world.altervista.org"><strong>Galandas</strong></a>',
	'ACP_LAST_TOPIC_SETTINGS'						=> '启用禁用',
	'ACP_LAST_TOPIC_CONF'								=> '配置',
	'ACP_LAST_TOPIC_CONFS'							=> '设置',
	'ACP_LAST_TOPIC_DONATE'							=> '<a href="https://www.paypal.me/Galandas"><strong>捐赠</strong></a>',
	'ACP_LAST_TOPIC_DONATE_EXPLAIN'			=> '如果您喜欢这个扩展，请考虑捐赠一份披萨',
	'LAST_TOPIC_CONFIG_SAVED'						=> '高级活跃主题设置已保存',
	'ALLOW_LAST_TOPIC'									=> '启用',
	'ALLOW_LAST_TOPIC_EXPLAIN'					=> '启用或禁用高级活跃主题',
	'ALLOW_LAST_TUTTO'									=> '启用整体',
	'ALLOW_LAST_TUTTO_EXPLAIN'					=> '启用或禁用在整个论坛中查看高级活跃主题，而不仅仅是在索引中',
	'LAST_TOPIC_ALLERTS'								=> '注意：如果您在论坛周围启用了视图，则必须在索引中禁用视图，否则他们将看到两个',
	'ALLOW_LAST_INDEX'									=> '在索引中启用',
	'ALLOW_LAST_INDEX_EXPLAIN'					=> '启用或禁用在索引上查看高级活跃主题',
	'LAST_TOPIC_ALLERT'									=> '注意：如果您仅在索引中启用视图，则必须在论坛周围禁用视图，否则他们将看到两个',
	'LAST_TOPIC_TOTAL'									=> '总主题数',
	'LAST_TOPIC_TOTAL_EXPLAIN'					=> '输入您希望向用户显示的主题数',
	'LAST_TYPE'													=> '模板',
	'LAST_TYPE_EXPLAIN'									=> '选择要显示的模板-当前选项为<strong>Forabg, Panel bg3</strong>',
	'LAST_DIRECTION'										=> '跑马灯方向',
	'LAST_DIRECTION_EXPLAIN'						=> '选择js的方向-当前选项为Up或Down',
	'LAST_UP_DIRECTION'									=> '向上',
	'LAST_DOWN_DIRECTION'								=> '向下',
	'LAST_TITLETEXT'										=> '活跃主题',
	'LAST_POS'													=> '位置',
	'LAST_POS_EXPLAIN'									=> '选择位置。在导航栏后面，出现在论坛列表之前的顶部。<br />在统计信息之后，它将出现在论坛统计信息之后。',
	'LAST_AT_TOP'												=> '在导航栏后面',
	'LAST_AT_FUT'												=> '在统计信息之后',
	'LAST_ASPECT_A'											=> 'Panel bg3',
	'LAST_ASPECT_B'											=> 'Forabg',
	'LAST_NAVIGATION'										=> '启用按钮',
  'LAST_NAVIGATION_EXPLAIN'						=> '您可以决定是否在高级活跃主题下显示按钮', 
	'PREVIOUS_SCROLL'										=> '后退',
	'NEXT_SCROLL'												=> '前进',
	'START_SCROLL'											=> '播放',
	'STOP_SCROLL'												=> '停止',
	'ACL_U_AT_ADV'											=> '可以查看高级活跃主题'
));