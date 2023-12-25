<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\referral\ucp;

class ucp_referral_module
{
	public $u_action;

	public function main($id, $mode)
	{
		global $phpbb_container, $user;

		// Get an instance of the UCP controller
		$controller = $phpbb_container->get('dmzx.referral.ucp.controller');

		// Make the $u_action url available in the UCP controller
		$controller->set_page_url($this->u_action);

		switch ($mode)
		{
			case 'statistics':
				// Load a template for our UCP page
				$this->tpl_name = 'ucp_referral_statistics';
				// Set the page title for our UCP page
				$this->page_title = $user->lang['UCP_STATISTICS'];
				// Load the display statistics handle in the ucp controller
				$controller->display_statistics();
			break;

			case 'referrals':
				// Load a template for our UCP page
				$this->tpl_name = 'ucp_referral_referrals';
				// Set the page title for our UCP page
				$this->page_title = $user->lang['UCP_REFERRALS'];
				// Load the display referrals handle in the ucp controller
				$controller->display_referrals();
			break;

			case 'invite':
				// Load a template for our UCP page
				$this->tpl_name = 'ucp_referral_invite';
				// Set the page title for our UCP page
				$this->page_title = $user->lang['UCP_INVITE'];
				// Load the display invite handle in the ucp controller
				$controller->display_invite();
			break;
		}
	}
}
