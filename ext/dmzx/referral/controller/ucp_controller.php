<?php
/**
*
* @package phpBB Extension - Referrals
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\referral\controller;

use phpbb\user;
use phpbb\template\template;
use phpbb\db\driver\driver_interface as db_interface;
use phpbb\request\request_interface;

class ucp_controller
{
	/** @var user */
	protected $user;

	/** @var template */
	protected $template;

	/** @var db_interface */
	protected $db;

	/** @var request_interface */
	protected $request;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/** @var string */
	protected $referral_table;

	/** @var string */
	protected $referral_contests_table;

	/**
	* Constructor
	*
	* @param ser					$user
	* @param template				$template
	* @param db_interface			$db
	* @param request_interface		$request
	* @param string					$root_path
	* @param string 				$php_ext
	* @param string					$referral_table
	* @param string					$referral_contests_table
	*
	*/
	public function __construct(
		user $user,
		template $template,
		db_interface $db,
		request_interface $request,
		$root_path,
		$php_ext,
		$referral_table,
		$referral_contests_table
	)
	{
		$this->user						= $user;
		$this->template					= $template;
		$this->db						= $db;
		$this->request					= $request;
		$this->root_path 				= $root_path;
		$this->php_ext 					= $php_ext;
		$this->referral_table 			= $referral_table;
		$this->referral_contests_table 	= $referral_contests_table;
	}

	public function display_statistics()
	{
		$sql = 'SELECT COUNT(referral_username) as total_referrals
			FROM ' . $this->referral_table . '
			WHERE referrer_username="' . $this->user->data['username'] . '"';
		$result = $this->db->sql_query($sql);
		$total_referrals = $this->db->sql_fetchfield('total_referrals');
		$this->db->sql_freeresult($result);

		$sql = 'SELECT COUNT(contest_winner) as contest_winner
			FROM ' . $this->referral_contests_table . '
			WHERE contest_winner="' . $this->user->data['username'] . '"';
		$result = $this->db->sql_query($sql);
		$contest_winner = $this->db->sql_fetchfield('contest_winner');
		$this->db->sql_freeresult($result);

		$this->template->assign_vars(array(
			'REFERRAL_LINK'		=> generate_board_url() . "/index.$this->php_ext?r=" . $this->user->data['user_id'],
			'TOTAL_REFERRALS' 	=> $total_referrals,
			'CONTESTS_WON'		=> $contest_winner,
		));
	}

	public function display_referrals()
	{
		$sql = 'SELECT *
			FROM ' . $this->referral_table . '
				LEFT JOIN ' . USERS_TABLE . '
				ON referral_username = username
			WHERE referrer_id = ' . $this->user->data['user_id'];
			$result = $this->db->sql_query($sql);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$this->template->assign_block_vars('referrals',array(
				'REFERRAL_USERNAME' => get_username_string('full', $row['user_id'], $row['referral_username'], $row['user_colour']),
			));
		}
	}

	public function display_invite()
	{
		include_once($this->root_path . 'includes/functions_messenger.' . $this->php_ext);
		$messenger = new \messenger(false);

		$submit			= $this->request->is_set('submit') ? true : false;
		$recipients		= $this->request->variable('recipients', '');
		$sender_email 	= $this->request->variable('sender_email','');
		$subject		= $this->request->variable('subject', '', true);
		$message		= $this->request->variable('message', '', true);

		$this->template->assign_vars(array(
			'SENDER_EMAIL' 	=> ($sender_email) ? $sender_email : $this->user->data['user_email'],
			'RECIPIENTS'	=> $recipients,
			'SUBJECT'		=> $subject,
			'MESSAGE'		=> $message,
		));

		if ($submit)
		{
			$recipients = array_unique(explode("\n",$recipients));
			$total_recipients = count($recipients);

			if ($total_recipients >= 1 && !empty($sender_email) && !empty($subject) && !empty($message))
			{
				foreach ($recipients as $recipient)
				{
					$messenger->template('@dmzx_referral/referrals_send_invitation', $this->user->data['user_lang']);
					$messenger->to($recipient, '');
					$messenger->from($sender_email, '');
					$messenger->assign_vars(array(
						'SUBJECT'		 	=> $subject,
						'MESSAGE'		 	=> $message,
						'REFERRAL_LINK'		=> generate_board_url() . "/index.$this->php_ext?r=" . $this->user->data['user_id'],
					));
					$messenger->send();
				}
				$messenger->save_queue();

				meta_refresh(3, $this->u_action);
				$message = $this->user->lang['INVITATION_SENT'] . '<br /><br />' . sprintf($this->user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
				trigger_error($message);
			}
			else
			{
				$this->template->assign_vars(array(
					'FORM_ERROR'		=> true,
				));
			}
		}
	}

	/**
	* Set page url
	*
	* @param string $u_action Custom form action
	* @return null
	* @access public
	*/
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
