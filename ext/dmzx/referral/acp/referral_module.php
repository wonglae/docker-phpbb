<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\referral\acp;

class referral_module
{
	public $u_action;

	function main($id, $mode)
	{
		global $phpbb_container, $user;

		// Get an instance of the admin controller
		$admin_controller = $phpbb_container->get('dmzx.referral.admin.controller');

		// Make the $u_action url available in the admin controller
		$admin_controller->set_page_url($this->u_action);

		switch ($mode)
		{
			case 'config':
				// Load a template from adm/style for our ACP page
				$this->tpl_name = 'acp_referral_config';
				// Set the page title for our ACP page
				$this->page_title = $user->lang['ACP_REFERRAL_CONFIG'];
				// Load the display config handle in the admin controller
				$admin_controller->display_config();
			break;

			case 'contests':
				// Load a template from adm/style for our ACP page
				$this->tpl_name = 'acp_referral_contests';
				// Set the page title for our ACP page
				$this->page_title = $user->lang['ACP_REFERRAL_CONTESTS'];
				// Load the display contests handle in the admin controller
				$admin_controller->display_contests();
			break;

			case 'referrers':
				// Load a template from adm/style for our ACP page
				$this->tpl_name = 'acp_referral_referrers';
				// Set the page title for our ACP page
				$this->page_title = $user->lang['ACP_REFERRERS_LIST'];
				// Load the display referrers handle in the admin controller
				$admin_controller->display_referrers();
			break;
		}
	}
}
