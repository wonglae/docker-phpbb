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

    private $b_forceUnhide = false;
    private $b_topic_replied = false;

    private $hbuid; // Hide Bbcode UID (Unique Identification Digit)

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
            'core.viewtopic_assign_template_vars_before'    => 'check_user_posted_viewtopic',
            'core.text_formatter_s9e_render_before'         => 'text_formatter_inject_render_params',
            'core.modify_posting_auth'                      => 'verify_allow_user_posting',
        );
    }

    public function load_language_on_setup($event)
    {
        $lang_set_ext = $event['lang_set_ext'];
        $lang_set_ext[] = array(
            'ext_name' => 'towang/advancedbbcode',
            'lang_set' => 'posting',
        );
        $event['lang_set_ext'] = $lang_set_ext;
    }

    public function verify_allow_user_posting($event)
    {
        $post_mode = $event['mode'];
        $post_data = $event['post_data'];
        $post_text = $post_data['post_text'];

        // Don't allow quote if S_TOPIC_REPLIED used in BBcode
        if ($post_mode == 'quote')
        {
            if (strpos($post_text, '[reply]') && strpos($post_text, '[/reply]'))
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
        $topic_replied = $this->template->retrieve_var('S_TOPIC_REPLIED');
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

        $renderer = $event['renderer']->get_renderer();
        $renderer->setParameters(array(
            'S_TOPIC_REPLIED'       => $topic_replied,
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
    }

    /**
     * Check whether user replied the topic
     *
     * @param object $event The event object
     */
    public function check_user_posted_viewtopic($event)
    {
        $user_id = $this->user->data['user_id'];
        $topic_id = $event['topic_id'];
        $topic_data = $event['topic_data'];
        $total_posts = $event['total_posts'];

        if ($topic_id > 0 && $total_posts > 0)
        {
            $this->b_forceUnhide = false;
            $this->b_topic_replied = false;
            
            if ($user_id == $topic_data['topic_poster'])
            {
                error_log("viewtopic current user", 0);
                $this->b_forceUnhide = true;
            }

            // Check if a user has posted
            $this->check_user_posted_by_topicId($topic_id);
            
            $this->template->assign_vars(array(
                'S_TOPIC_REPLIED' => ($this->b_topic_replied || $this->b_forceUnhide) ? true : false,
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

        $sql = "SELECT forum_id 
            FROM " . TOPICS_TABLE . "
            WHERE topic_id = ".$topic_id." ";
        $result = $this->db->sql_query($sql);
        $forum_id = $this->db->sql_fetchrow($result);
        $forum_id = $forum_id['forum_id'];
        $this->db->sql_freeresult($result);

        if ($auth->acl_get('m_', $forum_id))
        {
            error_log("viewtopic admin", 0);

            // If moderator or admin, skip reply check, auto unhide
            $this->b_forceUnhide = true;
        }
        elseif ($this->user->data['user_id'] != ANONYMOUS)
        {
            // Check if the topic viewer has posted in the topic
            $sql = "SELECT poster_id, topic_id 
                FROM " . POSTS_TABLE . "
                WHERE topic_id = $topic_id 
                AND poster_id = " . $this->user->data['user_id'] . "
                AND post_visibility = " . ITEM_APPROVED;

            $result = $this->db->sql_query_limit($sql, 1, 0);
            $this->b_topic_replied = $this->db->sql_affectedrows($result) ? true : false;
            $this->db->sql_freeresult($result);
        }
    }
}