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
use phpbb\config\config;
use phpbb\request\request_interface;
use phpbb\pagination;

class admin_controller
{
	/** @var user */
	protected $user;

	/** @var template */
	protected $template;

	/** @var driver_interface */
	protected $db;

	/** @var config */
	protected $config;

	/** @var request_interface */
	protected $request;

	/** @var pagination */
	protected $pagination;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $referral_table;

	/** @var string */
	protected $referral_contests_table;

	/**
	* Constructor
	*
	* @param user					$user
	* @param template				$template
	* @param db_interface			$db
	* @param config					$config
	* @param request_interface 		$request
	* @param pagination				$pagination
	* @param string					$root_path
	* @param string					$referral_table
	* @param string					$referral_contests_table
	*
	*/
	public function __construct(
		user $user,
		template $template,
		db_interface $db,
		config $config,
		request_interface	$request,
		pagination $pagination,
		$root_path,
		$referral_table,
		$referral_contests_table
	)
	{
		$this->user						= $user;
		$this->template					= $template;
		$this->db						= $db;
		$this->config					= $config;
		$this->request					= $request;
		$this->pagination 				= $pagination;
		$this->root_path 				= $root_path;
		$this->referral_table 			= $referral_table;
		$this->referral_contests_table 	= $referral_contests_table;

		$this->user->add_lang_ext('dmzx/referral', 'acp_referral');
	}

	public function display_config()
	{
		$submit						= $this->request->is_set_post('submit');
		$top_five_referrers			= $this->request->variable('top_five_referrers', 0);
		$user_referrals_viewtopic	= $this->request->variable('user_referrals_viewtopic', 0);
		$user_referrals_profile		= $this->request->variable('user_referrals_profile', 0);
		$display_referral_contests 	= $this->request->variable('display_referral_contests', 0);

		if ($submit)
		{
			$this->config->set('top_five_referrers', $top_five_referrers);
			$this->config->set('user_referrals_viewtopic', $user_referrals_viewtopic);
			$this->config->set('user_referrals_profile', $user_referrals_profile);
			$this->config->set('referral_contests_display', $display_referral_contests);

			trigger_error(sprintf($this->user->lang['CONFIG_UPDATED']) . adm_back_link($this->u_action));
		}

		$this->template->assign_vars(array(
			'TOP_FIVE_REFERRERS'		=> $this->config['top_five_referrers'],
			'USER_REFERRALS_VIEWTOPIC'	=> $this->config['user_referrals_viewtopic'],
			'USER_REFERRALS_PROFILE'	=> $this->config['user_referrals_profile'],
			'DISPLAY_REFERRAL_CONTESTS' => $this->config['referral_contests_display'],
			'MOD_VERSION'	 			=> $this->config['referral_mod_version'],
			'U_ACTION'					=> $this->u_action,
		));
	}

	public function display_contests()
	{
		$action 		= $this->request->variable('action', '');
		$rid			= $this->request->variable('rid', 0);
		$contest_id 	= $this->request->variable('id', 0);
		$start_date	 	= $this->request->variable('start_date', 0);
		$end_date		= $this->request->variable('end_date', 0);
		$ref_min_posts	= $this->request->variable('ref_min_posts', 0);
		$start 			= $this->request->variable('start', 0);

		$s_hidden_fields = '';

		$action	 = ($this->request->is_set('add')) ? 'add' : (($this->request->is_set('save')) ? 'save' : $action);

		$form_name = 'acp_referral_contests';
		add_form_key($form_name);

		$time_options = array(
			'days'		=> $this->user->lang['DAYS'],
			'weeks'		=> $this->user->lang['WEEKS'],
			'months' 	=> $this->user->lang['MONTHS'],
		);

		switch ($action)
		{
			case 'edit':

				$sql = 'SELECT *
					FROM ' . $this->referral_contests_table . "
					WHERE contest_id = $contest_id";
				$result = $this->db->sql_query($sql);
				$contest_info = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				$s_hidden_fields .= '<input type="hidden" name="id" value="' . $contest_id . '" />';

			case 'add':

				$sql = 'SELECT *
					FROM ' . $this->referral_contests_table . "
					WHERE contest_id = $contest_id";
				$result = $this->db->sql_query($sql);
				$contest_info = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				$contest_duration		 	= explode(' ', $contest_info['contest_duration']);
				$contest_duration_options 	= '';

				foreach ($time_options as $key => $val)
				{
					if ($contest_duration == $val)
					{
						$contest_duration_options .= "<option value='$key' selected='selected'>$val</option>";
					}
					else
					{
						$contest_duration_options .= "<option value='$key'>$val</option>";
					}
				}

				$this->template->assign_vars(array(
					'S_EDIT_CONTEST'			=> true,
					'CONTEST_NAME'			 	=> (isset($contest_info['contest_name'])) ? $contest_info['contest_name'] : '',
					'CONTEST_DESCRIPTION'		=> (isset($contest_info['contest_description'])) ? $contest_info['contest_description'] : '',
					'CONTEST_CONDITION'			=> (isset($contest_info['contest_condition'])) ? $contest_info['contest_condition'] : 0,
					'CONTEST_DURATION_VAL'	 	=> $contest_duration[0],
					'CONTEST_DURATION_OPTIONS' 	=> $contest_duration_options,
				));

				$contest_start_date			= (isset($contest_info['contest_start_date'])) ? $contest_info['contest_start_date'] : time();
				$contest_end_date		 	= (isset($contest_info['contest_end_date'])) ? $contest_info['contest_end_date'] : 0;
				$contest_duration_current 	= (isset($contest_info['contest_duration'])) ? $contest_info['contest_duration'] : 0;

				$s_hidden_fields .= '<input type="hidden" name="contest_start_date" value="' . $contest_start_date . '" />';
				$s_hidden_fields .= '<input type="hidden" name="contest_end_date" value="' . $contest_end_date . '" />';
				$s_hidden_fields .= '<input type="hidden" name="contest_duration_current" value="' . $contest_duration_current . '" />';

			break;

			case 'save':

				if (!check_form_key($form_name))
				{
					trigger_error($this->user->lang['FORM_INVALID']. adm_back_link($this->u_action), E_USER_WARNING);
				}

				$contest_id					= $this->request->variable('id', 0);
				$contest_name		 		= $this->request->variable('contest_name', '', true);
				$contest_description 		= $this->request->variable('contest_description', '', true);
				$contest_condition			= $this->request->variable('contest_condition', 0);
				$contest_start_date			= $this->request->variable('contest_start_date', 0);
				$contest_end_date		 	= $this->request->variable('contest_end_date', 0);
				$contest_duration			= $this->request->variable('contest_duration', array('' => ''));
				$contest_duration_current 	= $this->request->variable('contest_duration_current', '');
				$contest_status				= $this->request->variable('contest_status', '');

				if ($contest_name === '')
				{
					trigger_error($this->user->lang['ENTER_CONTEST_NAME'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$sql = 'SELECT *
					FROM ' . $this->referral_contests_table . "
					WHERE contest_id = $contest_id";
				$result = $this->db->sql_query($sql);
				$contest_info = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				$sql_ary = array(
					'contest_name'			=> $contest_name,
					'contest_description' 	=> $contest_description,
					'contest_condition'		=> $contest_condition,
					'contest_start_date'	=> $contest_start_date,
					'contest_end_date'		=> ($contest_duration_current == ($contest_duration[0] . ' ' . $time_options[$contest_duration[1]])) ? $contest_end_date : strtotime('+ ' . $contest_duration[0] . ' ' . $contest_duration[1]),
					'contest_duration'		=> $contest_duration[0] . ' ' . $time_options[$contest_duration[1]],
				);

				if ($contest_id)
				{
					$this->db->sql_query('UPDATE ' . $this->referral_contests_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . ' WHERE contest_id = ' . $contest_id);
				}
				else
				{
					$this->db->sql_query('INSERT INTO ' . $this->referral_contests_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary));
				}

				$message = ($contest_id) ? $this->user->lang['CONTEST_INFO_UPDATED'] : $this->user->lang['CONTEST_ADDED'];
				trigger_error($message . adm_back_link($this->u_action));

			break;

			case 'delete':

				if (!$contest_id)
				{
					trigger_error($this->user->lang['NO_CONTEST_SELECTED'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$sql = 'SELECT *
					FROM ' . $this->referral_contests_table . "
					WHERE contest_id = $contest_id";
				$result = $this->db->sql_query($sql);
				$contest_info = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				if (confirm_box(true))
				{
					$sql = 'DELETE FROM ' . $this->referral_contests_table . "
						WHERE contest_id = $contest_id";
					$this->db->sql_query($sql);

					trigger_error($this->user->lang['CONTEST_DELETED'] . adm_back_link($this->u_action));
				}
				else
				{
					confirm_box(false, $this->user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'id'		=> $contest_id,
						'action'	=> 'delete',
						))
					);
				}

			break;

			case 'stats':

				$this->template->assign_vars(array(
					'VIEW_STATS'	=> true,
				));

				$sql = 'SELECT * ,
					COUNT(referrer_username) AS referrals_count
					FROM ' . $this->referral_table . '
						LEFT JOIN ' . USERS_TABLE . '
						ON referral_username = username
					WHERE referral_since
					BETWEEN ' . $start_date . '
						AND ' . $end_date . '
						AND user_posts >= ' . $ref_min_posts . '
					GROUP BY user_id, referral_id, referrer_username
					ORDER BY referrals_count DESC';
				$result = $this->db->sql_query($sql);

				$i = 1;
				$total_referrals = 0;

				while ($row = $this->db->sql_fetchrow($result))
				{
					$total_referrals += $row['referrals_count'];

					$this->template->assign_block_vars('contest_stats', array(
						'REFERRER_USERNAME' => $row['referrer_username'],
						'REFERRALS_COUNT'	=> $row['referrals_count'],
						'VIEW_REFERRALS'	=> $this->u_action . '&amp;action=view_cr&amp;rid=' . $row['referrer_id'] . '&amp;start_date=' . $start_date . '&amp;end_date=' . $end_date . '&amp;ref_min_posts=' . $ref_min_posts,
						'TOTAL_REFERRALS'	=> $total_referrals,
						'CONTEST_POS'		=> ($i <= 3) ? '<img src="' . $this->root_path . 'ext/dmzx/referral/styles/all/theme/images/contest_pos_' . $i . '.gif" />' : $i,
					));
					$i++;
				}
				$this->db->sql_freeresult($result);

			break;

			case 'view_cr':

				$this->template->assign_vars(array(
					'VIEW_REFERRALS'	=> true,
				));

				$sql = 'SELECT *
					FROM ' . $this->referral_table . '
						LEFT JOIN ' . USERS_TABLE . '
						ON referral_username = username
					WHERE referral_since
					BETWEEN ' . $start_date . '
						AND ' . $end_date . '
						AND user_posts >= ' . $ref_min_posts . '
						AND referrer_id = ' . (int) $rid . '
					ORDER BY referral_since ASC';
				$result = $this->db->sql_query($sql);

				while ($row = $this->db->sql_fetchrow($result))
				{
					$this->template->assign_block_vars('view_referrals', array(
						'REFERRAL_USERNAME' => get_username_string('full', $row['user_id'], $row['referral_username'], $row['user_colour']),
						'USER_POSTS'		=> $row['user_posts'],
						'REFERRAL_SINCE'	=> $this->user->format_date($row['referral_since']),
					));
				}

			break;
		}

		$limit = 25;

		$sql = 'SELECT *
			FROM ' . $this->referral_contests_table . '
			ORDER BY contest_end_date DESC';
		$result = $this->db->sql_query_limit($sql, $limit, $start);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$this->template->assign_block_vars('contests', array(
				'CONTEST_NAME'			=> $row['contest_name'],
				'CONTEST_START_DATE' 	=> $this->user->format_date($row['contest_start_date']),
				'CONTEST_END_DATE'		=> $this->user->format_date($row['contest_end_date']),
				'CONTEST_DURATION'		=> $row['contest_duration'],
				'CONTEST_STATUS'	 	=> ($row['contest_end_date'] < time()) ? '<span style="color:red;">' . $this->user->lang['CONTEST_OVER'] . '</span>' : '<span style="color:green;">' . $this->user->lang['CONTEST_IN_PROGRESS'] . '</span>',
				'U_EDIT'			 	=> $this->u_action . '&amp;action=edit&amp;id=' . $row['contest_id'],
				'U_DELETE'			 	=> $this->u_action . '&amp;action=delete&amp;id=' . $row['contest_id'],
				'U_STATS'			 	=> $this->u_action . '&amp;action=stats&amp;id=' . $row['contest_id'] . '&amp;start_date=' . $row['contest_start_date'] . '&amp;end_date=' . $row['contest_end_date'] . '&amp;ref_min_posts=' . $row['contest_condition'],
			));
		}
		$this->db->sql_freeresult($result);

		$sql = 'SELECT COUNT(contest_id) AS total_contests
			FROM ' . $this->referral_contests_table;
		$result = $this->db->sql_query($sql);
		$total_contests = (int) $this->db->sql_fetchfield('total_contests');

		$base_url = $this->u_action;
		//Start pagination
		$this->pagination->generate_template_pagination($base_url, 'pagination', 'start', $total_contests, $limit, $start);

		$this->template->assign_vars(array(
			'TOTAL_CONTESTS' 	=> ($total_contests == 1) ? $this->user->lang['LIST_CONTEST'] : sprintf($this->user->lang['LIST_CONTESTS'], $total_contests),
			'ICON_STATS'	 	=> '<img src="' . $this->root_path . 'ext/dmzx/referral/styles/all/theme/images/icon_stats.png" alt="' . $this->user->lang['VIEW_STATISTICS'] . '" title="' . $this->user->lang['VIEW_STATISTICS'] . '" />',
			'MOD_VERSION'	 	=> $this->config['referral_mod_version'],
			'U_ACTION'			=> $this->u_action,
			'U_BACK'			=> $this->u_action,
			'S_HIDDEN_FIELDS' 	=> $s_hidden_fields,
		));
	}

	public function display_referrers()
	{
		$search_referrer 	= $this->request->variable('search_referrer', '');
		$action 			= $this->request->variable('action', '');
		$rid				= $this->request->variable('rid', 0);
		$start 				= $this->request->variable('start', 0);

		$limit = 25;

		if ($search_referrer)
		{
			$this->template->assign_vars(array(
				'SEARCH_REFERRER' 	=> true,
				'SEARCH_INPUT'		=> $search_referrer,
			));

			$sql = 'SELECT *
				FROM ' . USERS_TABLE . '
				WHERE username = "' . (int) $search_referrer . '"
				AND user_referrals >= 1
				ORDER BY user_referrals DESC';
		}
		else
		{
			$sql = 'SELECT *
				FROM ' . USERS_TABLE . '
				WHERE user_type IN (' . USER_NORMAL . ', ' . USER_FOUNDER . ')
				AND user_referrals >= 1
				ORDER BY user_referrals DESC';
		}

		$result = $this->db->sql_query($sql);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$this->template->assign_block_vars('referrers_list', array(
				'USERNAME'		 	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				'USER_ID'			=> $row['user_id'],
				'REFERRALS'			=> $row['user_referrals'],
				'U_VIEW_REFERRALS' 	=> $this->u_action . '&amp;action=view_referrals&amp;rid=' . $row['user_id'],
			));
		}
		$this->db->sql_freeresult($result);

		$sql = 'SELECT COUNT(user_id) AS total_referrers
			FROM ' . USERS_TABLE . '
			WHERE user_type IN (' . USER_NORMAL . ', ' . USER_FOUNDER . ')
				AND user_referrals >= 1 ';
		$result = $this->db->sql_query($sql);
		$total_referrers = (int) $this->db->sql_fetchfield('total_referrers');

		$base_url = $this->u_action;
		//Start pagination
		$this->pagination->generate_template_pagination($base_url, 'pagination', 'start', $total_referrers, $limit, $start);

		$this->template->assign_vars(array(
			'TOTAL_REFERRERS'	 	=> ($total_referrers == 1) ? $this->user->lang['LIST_REFERRER'] : sprintf($this->user->lang['LIST_REFERRERS'], $total_referrers),
			'MOD_VERSION'	 		=> $this->config['referral_mod_version'],
			'U_ACTION'				=> $this->u_action,
			'U_BACK'				=> $this->u_action,
		));

		switch ($action)
		{
			case 'view_referrals':

				$this->template->assign_vars(array(
					'VIEW_REFERRALS' => true,
				));

				$sql = 'SELECT *
					FROM ' . $this->referral_table . '
					LEFT JOIN ' . USERS_TABLE . '
						ON referral_username = username
					WHERE referrer_id = ' . (int) $rid;
				$result = $this->db->sql_query($sql);

				while ($row = $this->db->sql_fetchrow($result))
				{
					$this->template->assign_block_vars('referrals_list', array(
						'USERNAME'			=> get_username_string('full', $row['user_id'], $row['referral_username'], $row['user_colour']),
						'REFERRER'			=> $row['referrer_username'],
						'REFERRAL_SINCE' 	=> $this->user->format_date($row['referral_since']),
						'REFERRAL_POSTS' 	=> $row['user_posts']
					));
				}
				$this->db->sql_freeresult($result);

			break;
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
