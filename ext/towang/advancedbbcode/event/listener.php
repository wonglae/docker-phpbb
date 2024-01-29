<?php
/** 
 *
 * @package Hide_BBcode
 * @copyright (c) 2015 Marco van Oort
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
 *
 */

namespace towang\advancedbbcode\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
  protected $db;
  protected $user;
  protected $template;
  protected $config;
  protected $helper;

  private $b_topic_replied = false;
  private $b_topic_replied_today = false;

  private $hbuid; // Hide Bbcode UID (Unique Identification Digit)

  private $enable_topic_thumbnail = false;
  private $attachments = [];

  /**
   * Constructor
   *
   * @param \phpbb\db\driver\driver $db Database object
   * @param \phpbb\controller\helper    $helper        Controller helper object
   */
  public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\user $user, \phpbb\template\template $template, \phpbb\config\config $config, \phpbb\controller\helper $helper)
  {
    $this->db = $db;
    $this->user = $user;
    $this->template = $template;
    $this->config = $config;
    $this->helper = $helper;

    $this->hbuid = substr(md5(mt_rand()), 0, 10);
  }

  static public function getSubscribedEvents()
  {
    return array(
      'core.user_setup'                               => 'load_language_on_setup',
      'core.viewtopic_modify_post_row'                => 'check_hidden_attachments',
      'core.posting_modify_row_data'                  => 'check_user_posted_posting',
      'core.viewtopic_assign_template_vars_before'    => 'check_user_posted_viewtopic',
      'core.text_formatter_s9e_render_before'         => 'text_formatter_inject_render_params',
      'core.modify_posting_auth'                      => 'verify_allow_user_posting',
      'core.twig_environment_render_template_after'   => 'inject_bbcode_css',
      'core.viewforum_get_topic_data'                 => 'viewforum_get_topic_data',
      'core.viewforum_modify_topics_data'             => 'viewforum_modify_topics_data',
      'core.viewforum_modify_topicrow'                => 'viewforum_modify_topicrow',
    );
  }

  public function viewforum_get_topic_data($event)
  {
    $forum_data = $event['forum_data'];
    $this->enable_topic_thumbnail = $forum_data['forum_style'] == 12;
  }

  public function viewforum_modify_topics_data($event)
  {
    if (!$this->enable_topic_thumbnail)
    {
      return;
    }

    $rowset = $event['rowset'];
    $attach_list = array();
    foreach ($rowset as $t_id => $row)
    {
      $attach_list[] = (int) $row['topic_first_post_id'];
    }

    $sql = 'SELECT *
			FROM ' . ATTACHMENTS_TABLE . '
			WHERE ' . $this->db->sql_in_set('post_msg_id', $attach_list) . '
				AND in_message = 0
			ORDER BY attach_id DESC, post_msg_id ASC';
    $result = $this->db->sql_query($sql);

    while ($row = $this->db->sql_fetchrow($result))
		{
			$this->attachments[$row['post_msg_id']][] = $row;
		}

    $this->db->sql_freeresult($result);
  }

  public function viewforum_modify_topicrow($event)
  {
    if (!$this->enable_topic_thumbnail)
    {
      return;
    }
    
    global $phpbb_root_path, $phpEx;
    $row = $event['row'];
    $post_id = (int) $row['topic_first_post_id'];
    $topic_thumbnail = null;
    if (array_key_exists($post_id, $this->attachments)) {
      $attachments = $this->attachments[$post_id];
      foreach ($attachments as $attachment)
      {
        if ($attachment['mimetype'] == 'image/jpeg' && ($topic_thumbnail === null || $attachment['attach_comment'] == 'thumbnail'))
        {
          $topic_thumbnail = $attachment['attach_id'];
        }
      }
    }

    $topic_row = $event['topic_row'];
    if ($topic_thumbnail !== null)
    {
      $topic_row['TOPIC_THUMBNAIL_IMG'] = append_sid("{$phpbb_root_path}download/file.$phpEx", 'id=' . $attachment['attach_id']);
    }
    else
    {
      $topic_row['TOPIC_THUMBNAIL_IMG'] = $phpbb_root_path . 'aci/phpbb-storage/missing_thumbnail.jpg';
    }
    $event['topic_row'] = $topic_row;
  }

  public function check_user_posted_posting($event)
  {
    $post_data = $event['post_data'];
    // New post or the post belongs to the user
    if (!array_key_exists('poster_id', $post_data) || $post_data['poster_id'] == $this->user->data['user_id'])
    {
      $this->template->assign_vars(array(
        'S_IN_POSTING' => true,
      ));
    }
  }

  public function check_hidden_attachments($event)
  {
    $row = $event['row'];
    $post_text = array_key_exists('post_text',$row) ? $row['post_text'] : '';
    if ((strpos($post_text, '[reply]') && strpos($post_text, '[/reply]')) ||
        (strpos($post_text, '[member]') && strpos($post_text, '[/member]')) ||
        (strpos($post_text, '[rank') && strpos($post_text, '[/rank')))
    {
      $post_row = $event['post_row'];
      $post_row['S_HAS_ATTACHMENTS'] = false;
      $event['post_row'] = $post_row;
    }
  }

  public function inject_bbcode_css($event)
  {
    global $phpbb_root_path, $phpbb_filesystem;
    
    $output = $event['output'];
    $context = $event['context'];
    if (array_key_exists('definition', $context))
    {
      $styleSheetsPlaceholder = $context['definition']->__call('STYLESHEETS', null);
      $bbcodeCSS = $phpbb_root_path . 'aci/phpbb-storage/bbcode.css';

      if ($phpbb_filesystem->exists($bbcodeCSS))
      {
        $output = str_replace(
          $styleSheetsPlaceholder,
          "<link href=\"{$bbcodeCSS}?assets_version={$this->config['assets_version']}\" rel=\"stylesheet\" media=\"screen\">\n{$styleSheetsPlaceholder}",
          $output
        );
        $event['output'] = $output;
      }
    }
  }

  public function load_language_on_setup($event)
  {
    global $phpbb_root_path, $phpEx;
    $lang_set_ext = $event['lang_set_ext'];
    $lang_set_ext[] = array(
      'ext_name' => 'towang/advancedbbcode',
      'lang_set' => 'posting',
    );
    $event['lang_set_ext'] = $lang_set_ext;

    $topic_id = $this->config['towang_advancedbbcode_checkin_post_id'];
    if (!empty($topic_id))
		{
			$this->template->assign_var('U_CHECKIN_POST', append_sid("{$phpbb_root_path}viewtopic.$phpEx", 't=' . $topic_id));
		}
  }

  public function verify_allow_user_posting($event)
  {
    $post_mode = $event['mode'];
    $post_data = $event['post_data'];
    $post_text = array_key_exists('post_text',$post_data) ? $post_data['post_text'] : '';

    // Don't allow quote if S_TOPIC_REPLIED used in BBcode
    if ($post_mode == 'quote')
    {
      if ((strpos($post_text, '[reply]') && strpos($post_text, '[/reply]')) ||
          (strpos($post_text, '[member]') && strpos($post_text, '[/member]')) ||
          (strpos($post_text, '[rank') && strpos($post_text, '[/rank')))
      {
        $event['is_authed'] = false;
        $event['error'] = array('POSTING_QUOTE_HIDDEN_CONTENT_NOT_ALLOW');
      }
    }
  }

  /**
   * Append custom parameters to renderer
   *
   * @param object $event The event object
   */
  public function text_formatter_inject_render_params($event)
  {
    global $ranks;

    if (empty($ranks))
    {
      global $cache;
      $ranks = $cache->obtain_ranks();
    }

    $user_posts = $this->user->data['user_posts'];
    $user_rank = $this->user->data['user_rank'];
    $special_rank = !empty($ranks['special'][$user_rank]) ? $user_rank : -1;
    
    $user_rank_weighting = $this->template->retrieve_var('S_USER_RANK_WEIGHTING');
    $in_posting = $this->template->retrieve_var('S_IN_POSTING') ? true : false;
    $topic_replied = $this->template->retrieve_var('S_TOPIC_REPLIED') ? true : false;
    $topic_replied_today = $this->template->retrieve_var('S_TOPIC_REPLIED_TODAY') ? true : false;
    $forum_id = $this->template->retrieve_var('S_FORUM_ID');
    $topic_id = $this->template->retrieve_var('S_TOPIC_ID');
    $login_action = $this->template->retrieve_var('S_LOGIN_ACTION');
    $login_redirect = $this->template->retrieve_var('S_LOGIN_REDIRECT');
    $bump_topic = $this->template->retrieve_var('U_BUMP_TOPIC');
    $new_topic = $this->template->retrieve_var('U_POST_NEW_TOPIC');
    $reply_topic = $this->template->retrieve_var('U_POST_REPLY_TOPIC');
    $bookmark_topic = $this->template->retrieve_var('U_BOOKMARK_TOPIC');
    $watch_topic = $this->template->retrieve_var('U_WATCH_TOPIC');
    $view_topic = $this->template->retrieve_var('U_VIEW_TOPIC');
    $search_matches = $this->template->retrieve_var('SEARCH_MATCHES');

    $renderer = $event['renderer']->get_renderer();
    $renderer->setParameters(array(
      'S_IN_POSTING'          => $in_posting,
      'S_IN_SEARCHING'        => empty($search_matches) ? false: true,
      'S_USER_POSTS'          => $user_posts,
      'S_USER_RANK_SPECIAL'   => $special_rank, // -1 means no special rank
      'S_TOPIC_REPLIED'       => $topic_replied,
      'S_TOPIC_REPLIED_TODAY' => $topic_replied_today,
      'S_FORUM_ID'            => $forum_id,
      'S_TOPIC_ID'            => $topic_id,
      'S_LOGIN_ACTION'        => html_entity_decode($login_action),
      'S_LOGIN_REDIRECT'      => html_entity_decode($login_redirect),
      'U_BUMP_TOPIC'          => html_entity_decode($bump_topic),
      'U_POST_NEW_TOPIC'      => html_entity_decode($new_topic),
      'U_POST_REPLY_TOPIC'    => html_entity_decode($reply_topic),
      'U_BOOKMARK_TOPIC'      => html_entity_decode($bookmark_topic),
      'U_WATCH_TOPIC'         => html_entity_decode($watch_topic),
      'U_VIEW_TOPIC'          => html_entity_decode($view_topic),
    ));

    if (isset($user_rank_weighting))
    {
      $renderer->setParameters(array(
        'S_USER_RANK_VALUE'   => $user_posts + $user_rank_weighting,
      ));
    }
  }

  /**
   * Check whether user replied the topic
   *
   * @param object $event The event object
   */
  public function check_user_posted_viewtopic($event)
  {
    $user_id = $this->user->data['user_id'];
    $forum_id = $event['forum_id'];
    $topic_id = $event['topic_id'];
    $topic_data = $event['topic_data'];
    $total_posts = $event['total_posts'];

    if ($topic_id > 0 && $total_posts > 0)
    {
      $this->b_topic_replied = false;
      $this->b_topic_replied_today = false;

      // Check if a user has posted
      $this->check_user_posted_by_topicId($forum_id, $topic_id);

      $this->template->assign_vars(array(
        'S_TOPIC_SELF' => $user_id == $topic_data['topic_poster'],
        'S_TOPIC_REPLIED' => $this->b_topic_replied,
        'S_TOPIC_REPLIED_TODAY' => $this->b_topic_replied_today,
      ));
    }
  }

  /**
   * Check whether the user has posted in a topic
   *
   * @param int $topic_id The topic id
   */
  private function check_user_posted_by_topicId($topic_id)
  {
    global $auth;
    if ($this->user->data['user_id'] != ANONYMOUS)
    {
      // Check if the topic viewer has posted in the topic
      $sql = "SELECT DATE(from_unixtime(post_time)) as post_date, from_unixtime(post_time) as post_time
        FROM " . POSTS_TABLE . "
        WHERE topic_id = $topic_id 
          AND poster_id = " . $this->user->data['user_id'] . "
          AND post_visibility = " . ITEM_APPROVED ."
        ORDER BY post_time DESC";

      $result = $this->db->sql_query_limit($sql, 1, 0);
      
      $this->b_topic_replied = $this->db->sql_affectedrows($result) ? true : false;
      if ($this->b_topic_replied == true)
      {
        $post_date = $this->db->sql_fetchrow($result)['post_date'];

        if ($post_date == date('Y-m-d'))
        {
          $this->b_topic_replied_today = true;
        }
      }
      $this->db->sql_freeresult($result);
    }
  }
}
