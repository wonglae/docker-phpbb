<?php
/**
 *
 * Clipboard Image. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019 Jakub Senko
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
	'CLIPBOARDIMAGE_COPY'	=> '您的剪贴板包含文本和图像。您想要粘贴哪个项目？',
	'CLIPBOARDIMAGE_TEXT'	=> '文本',
	'CLIPBOARDIMAGE_IMAGE'	=> '图像',
	'CLIPBOARDIMAGE_BOTH'	=> '全部',
));
