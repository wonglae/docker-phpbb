<?php
/**
 *
 * Custom CSS. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace towang\advancedbbcode\acp;

/**
 * Custom CSS ACP module.
 */
class main_module
{
	public $page_title;
	public $tpl_name;
	public $u_action;

	protected $language;
	protected $request;
	protected $template;
	protected $config;
	protected $root_path;
	protected $custom_css_file;
	public function __construct()
	{
		global $phpbb_container;

		$this->language = $phpbb_container->get('language');
		$this->request = $phpbb_container->get('request');
		$this->template = $phpbb_container->get('template');
		$this->config = $phpbb_container->get('config');
		$this->root_path = $phpbb_container->getParameter('core.root_path');
	}

	public function main()
	{
		global $phpbb_filesystem;

		$this->language->add_lang('acp', 'towang/advancedbbcode');
		$this->tpl_name = 'advancedbbcode';
		$this->page_title = $this->language->lang('ACP_TOWANG_ADVANCEDBBOCDE_TITLE');
		$this->custom_css_file = $this->root_path . 'aci/phpbb-storage/bbcode.css';
		$phpbb_filesystem->mkdir(\dirname($this->custom_css_file));
		$phpbb_filesystem->touch($this->custom_css_file);

		if ($this->request->is_set_post('submit'))
		{
			$this->put_custom_css($this->request->variable('custom_css', '', true));

			// make sure browsers will download the file again and not use the cached version
			$this->config->increment('assets_version', 1);
		}

		$this->template->assign_vars([
			'U_ACTION'		=> $this->u_action,
			'CUSTOM_CSS'	=> $this->get_custom_css(),
		]);
	}

	protected function get_custom_css()
	{
		return file_get_contents($this->custom_css_file);
	}

	protected function put_custom_css($content)
	{
		file_put_contents($this->custom_css_file, $content);
	}
}
