<?php
/**
 *
 * Feed post bot. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, Ger, https	=>//github.com/GerB
 * @license GNU General Public License, version 2 (GPL-2.0)
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
	'FPB_ACP_FORUM_ID'									=> 'Feed论坛',
	'FPB_ACP_FORUM_ID_EXPLAIN'					=> '发布新鲜事的论坛。',
	'FPB_ACP_SETTINGS_EXPLAIN'					=> '您可以使用下面的表单添加RSS、ATOM或RDF源。从发布源URL开始。当您输入源时，您会发现一个包含以下参数的表格：',
	'FPB_ACP_FEEDPOSTBOT_SETTING_SAVED'	=> 'Feed发布机器人设置已保存',
	'FPB_ACP_FEEDPOSTBOT_TITLE'					=> 'Feed发布机器人',
	'FPB_ACP_FETCHED_ITEMS'							=> array(
		1																	=> '所有源已获取；创建了%d个新帖子',
		2																	=> '所有源已获取：%d个新帖子已创建'
	),
	'FPB_ACP_NO_FETCHED_ITEMS'					=> '没有（新的）要获取的项目',
	'FPB_ADD_FEED'											=> '添加源',
	'FPB_APPEND_LINK'										=> '附加链接',
	'FPB_APPEND_LINK_EXPLAIN'						=> '附加源项目的来源链接',
	'FPB_CRON_FREQUENCY'								=> '自动处理源的间隔（秒）。0表示禁用自动获取。',
	'FPB_CURDATE'												=> '本地日期/时间',
	'FPB_CURDATE_EXPLAIN'								=> '勾选以使用源获取时间作为发布时间。取消勾选以使用源PubDate作为发布时间。',
	'FPB_FETCH_ALL_FEEDS'								=> '手动获取所有源',
	'FPB_FEED_TYPE'											=> '源类型',
	'FPB_FEED_TYPE_EXPLAIN'							=> '源可以是ATOM、RDF或RSS。第一次输入源时，会自动检测类型。如果源没有返回任何要发布的项目，请尝试更改此设置。',
	'FPB_FEED_URL'											=> '源URL',
	'FPB_FEED_URL_EXPLAIN'							=> '实际源的URL，例如<code>https://www.phpbb.com/feeds/rss/</code>。每个源URL应该是唯一的',
	'FPB_FEED_URL_INVALID'							=> '无效的源URL。这可能是您的源列表中的重复项，也可能是不符合规范的URL',
	'FPB_FEEDS'													=> '源',
	'FPB_LOCKED_EXPLAIN'								=> '源处理已经开始但尚未完成，因此无法重新开始。如果持续出现此问题，您可以通过单击此按钮释放该进程。',
	'FPB_LOG_FEED_ERROR'								=> '源中的XML错误<br />» %s',
	'FPB_LOG_FEED_FETCHED'							=> '源已获取<br />» %s',
	'FPB_LOG_FEED_TIMEOUT'							=> '已达到源超时<br />» %s',
	'FPB_PREFIX'												=> '主题前缀',
	'FPB_PREFIX_EXPLAIN'								=> '您可以选择为主题添加前缀，例如“[phpBB RSS]”。不添加前缀则留空。',
	'FPB_NO_FEEDS'											=> '尚未添加源。',
	'FPB_READ_MORE'											=> '阅读更多',
	'FPB_REQUIRE_SIMPLEXML'							=> '服务器上没有可用的PHP <a href="https://www.php.net/manual/en/book.simplexml.php">SimpleXML扩展</a>。扩展需要此才能读取源，因此无法安装。',
	'FPB_SOURCE'												=> '来源：',
	'FPB_TEXTLIMIT'											=> '文本限制',
	'FPB_TEXTLIMIT_EXPLAIN'							=> '源文本限制为给定的字符数。请注意，此值适用于原始源文本，单词将保持完整。然后，将修复源中的任何损坏的HTML，并将其转换为BBcode，并附加带有“阅读更多”的链接。因此，限制仅是结果帖子文本的指示。<br>将其设置为0以禁用文本限制。',
	'FPB_TIMEOUT'												=> '超时',
	'FPB_TIMEOUT_EXPLAIN'								=> '请求源URL的超时时间。如果在没有检索到源内容的情况下经过了这段时间，则取消请求。',
	'FPB_TYPE_ATOM'											=> 'ATOM',
	'FPB_TYPE_RDF'											=> 'RDF',
	'FPB_TYPE_RSS'											=> 'RSS',
	'FPB_USER_ID'												=> '源用户ID',
	'FPB_USER_ID_EXPLAIN'								=> '将用于发布新项目的用户的ID。',
));
