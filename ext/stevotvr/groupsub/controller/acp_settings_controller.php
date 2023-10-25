<?php
/**
 *
 * Group Subscription. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, Steve Guidetti, https://github.com/stevotvr
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace stevotvr\groupsub\controller;

use phpbb\config\db_text;

/**
 * Group Subscription settings ACP controller.
 */
class acp_settings_controller extends acp_base_controller implements acp_settings_interface
{
	/**
	 * @var \phpbb\config\db_text
	 */
	protected $config_text;

	/**
	 * Set up the controller.
	 *
	 * @param \phpbb\config\db_text $config_text
	 */
	public function setup(db_text $config_text)
	{
		$this->config_text = $config_text;
	}

	/**
	 * @inheritDoc
	 */
	public function add_lang()
	{
		parent::add_lang();

		$this->language->add_lang('acp_settings', 'stevotvr/groupsub');
	}

	/**
	 * @inheritDoc
	 */
	public function handle()
	{
		$this->add_lang();

		$errors = array();

		add_form_key('stevotvr_groupsub_settings');

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('stevotvr_groupsub_settings'))
			{
				trigger_error('FORM_INVALID');
			}

			$data = array(
				'pp_sandbox'		=> $this->request->variable('pp_sandbox', true),
				'pp_sb_business'	=> $this->request->variable('pp_sb_business', ''),
				'pp_business'		=> $this->request->variable('pp_business', ''),
				'notify_admins'		=> $this->request->variable('notify_admins', false),
				'collapse_terms'	=> max(2, $this->request->variable('collapse_terms', 0)),
				'currency'			=> $this->request->variable('currency', ''),
				'warn_time'			=> max(0, $this->request->variable('warn_time', 0)),
				'grace'				=> max(0, $this->request->variable('grace', 0)),
			);

			$header = $this->request->variable('header', '', true);
			$header_bbcode = $this->request->variable('header_bbcode', false);
			$header_smilies = $this->request->variable('header_smilies', false);
			$header_magic_url = $this->request->variable('header_magic_url', false);
			$header_uid = $header_bitfield = $header_flags = '';
			generate_text_for_storage($header, $header_uid, $header_bitfield, $header_flags, $header_bbcode, $header_magic_url, $header_smilies);
			$data = array_merge($data, array(
				'header_bbcode_uid'			=> $header_uid,
				'header_bbcode_bitfield'	=> $header_bitfield,
				'header_bbcode_options'		=> (OPTION_FLAG_BBCODE * $header_bbcode) + (OPTION_FLAG_SMILIES * $header_smilies) + (OPTION_FLAG_LINKS * $header_magic_url),
			));
			$this->config_text->set('stevotvr_groupsub_header', $header);

			$footer = $this->request->variable('footer', '', true);
			$footer_bbcode = $this->request->variable('footer_bbcode', false);
			$footer_smilies = $this->request->variable('footer_smilies', false);
			$footer_magic_url = $this->request->variable('footer_magic_url', false);
			$footer_uid = $footer_bitfield = $footer_flags = '';
			generate_text_for_storage($footer, $footer_uid, $footer_bitfield, $footer_flags, $footer_bbcode, $footer_magic_url, $footer_smilies);
			$data = array_merge($data, array(
				'footer_bbcode_uid'			=> $footer_uid,
				'footer_bbcode_bitfield'	=> $footer_bitfield,
				'footer_bbcode_options'		=> (OPTION_FLAG_BBCODE * $footer_bbcode) + (OPTION_FLAG_SMILIES * $footer_smilies) + (OPTION_FLAG_LINKS * $footer_magic_url),
			));
			$this->config_text->set('stevotvr_groupsub_footer', $footer);

			if (!$this->currency->is_valid($data['currency']))
			{
				$errors[] = 'ACP_GROUPSUB_ERROR_CURRENCY';
			}

			if (!count($errors))
			{
				foreach ($data as $key => $value)
				{
					$this->config->set('stevotvr_groupsub_' . $key, $value);
				}

				$this->config->set('stevotvr_groupsub_active', !$data['pp_sandbox'] && $data['pp_business']);

				trigger_error($this->language->lang('ACP_GROUPSUB_SETTINGS_SAVED') . adm_back_link($this->u_action));
			}
		}

		$errors = array_map(array($this->language, 'lang'), $errors);

		$header_uid = $this->config['stevotvr_groupsub_header_bbcode_uid'];
		$header_options = $this->config['stevotvr_groupsub_header_bbcode_options'];
		$header = generate_text_for_edit($this->config_text->get('stevotvr_groupsub_header'), $header_uid, $header_options);

		$footer_uid = $this->config['stevotvr_groupsub_footer_bbcode_uid'];
		$footer_options = $this->config['stevotvr_groupsub_footer_bbcode_options'];
		$footer = generate_text_for_edit($this->config_text->get('stevotvr_groupsub_footer'), $footer_uid, $footer_options);

		$this->template->assign_vars(array(
			'ERROR_MESSAGE'	=> implode('<br>', $errors),

			'S_HEADER_BBCODE_CHECKED'		=> $header_options & OPTION_FLAG_BBCODE,
			'S_HEADER_SMILIES_CHECKED'		=> $header_options & OPTION_FLAG_SMILIES,
			'S_HEADER_MAGIC_URL_CHECKED'	=> $header_options & OPTION_FLAG_LINKS,
			'S_FOOTER_BBCODE_CHECKED'		=> $footer_options & OPTION_FLAG_BBCODE,
			'S_FOOTER_SMILIES_CHECKED'		=> $footer_options & OPTION_FLAG_SMILIES,
			'S_FOOTER_MAGIC_URL_CHECKED'	=> $footer_options & OPTION_FLAG_LINKS,

			'PP_SANDBOX'		=> $this->config['stevotvr_groupsub_pp_sandbox'],
			'PP_SB_BUSINESS'	=> $this->config['stevotvr_groupsub_pp_sb_business'],
			'PP_BUSINESS'		=> $this->config['stevotvr_groupsub_pp_business'],
			'CURRENCY'			=> $this->config['stevotvr_groupsub_currency'],
			'NOTIFY_ADMINS'		=> $this->config['stevotvr_groupsub_notify_admins'],
			'HEADER'			=> $header['text'],
			'FOOTER'			=> $footer['text'],
			'COLLAPSE_TERMS'	=> $this->config['stevotvr_groupsub_collapse_terms'],
			'WARN_TIME'			=> $this->config['stevotvr_groupsub_warn_time'],
			'GRACE'				=> $this->config['stevotvr_groupsub_grace'],

			'U_ACTION'	=> $this->u_action,
		));

		$this->assign_currency_vars();
	}
}
