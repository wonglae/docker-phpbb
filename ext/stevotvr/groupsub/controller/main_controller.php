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

use phpbb\auth\auth;
use phpbb\config\config;
use phpbb\config\db_text;
use phpbb\controller\helper;
use phpbb\exception\http_exception;
use phpbb\language\language;
use phpbb\log\log_interface;
use phpbb\request\request_interface;
use phpbb\template\template;
use phpbb\user;
use stevotvr\groupsub\operator\currency_interface;
use stevotvr\groupsub\operator\package_interface;
use stevotvr\groupsub\operator\subscription_interface;
use stevotvr\groupsub\operator\unit_helper_interface;
use stevotvr\groupsub\stripe\client_interface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Group Subscription controller for the main user-facing interface.
 */
class main_controller
{
	/**
	 * @var \phpbb\auth\auth
	 */
	protected $auth;

	/**
	 * @var \phpbb\config\config
	 */
	protected $config;

	/**
	 * @var \phpbb\config\db_text
	 */
	protected $config_text;

	/**
	 * @var \stevotvr\groupsub\operator\currency_interface
	 */
	protected $currency;

	/**
	 * @var \phpbb\controller\helper
	 */
	protected $helper;

	/**
	 * @var \phpbb\language\language
	 */
	protected $language;

	/**
	 * @var \stevotvr\groupsub\operator\package_interface
	 */
	protected $pkg_operator;

	/**
	 * @var \phpbb\request\request_interface
	 */
	protected $request;

	/**
	 * @var \stevotvr\groupsub\operator\subscription_interface
	 */
	protected $sub_operator;

	/**
	 * @var \phpbb\template\template
	 */
	protected $template;

	/**
	 * @var \stevotvr\groupsub\operator\unit_helper_interface
	 */
	protected $unit_helper;

	/**
	 * @var \phpbb\user
	 */
	protected $user;

	/** @var \stevotvr\groupsub\stripe\client_interface */
	protected $stripe;

	/** @var \phpbb\log\log_interface */
	protected $log;

	/**
	 * The root phpBB path.
	 *
	 * @var string
	 */
	protected $root_path;
	/**
	 * The script file extension.
	 *
	 * @var string
	 */
	protected $php_ext;

	/**
	 * @param \phpbb\auth\auth                                   $auth
	 * @param \phpbb\config\config                               $config
	 * @param \phpbb\config\db_text                              $config_text
	 * @param \stevotvr\groupsub\operator\currency_interface     $currency
	 * @param \phpbb\controller\helper                           $helper
	 * @param \phpbb\language\language                           $language
	 * @param \stevotvr\groupsub\operator\package_interface      $pkg_operator
	 * @param \phpbb\request\request_interface                   $request
	 * @param \stevotvr\groupsub\operator\subscription_interface $sub_operator
	 * @param \phpbb\template\template                           $template
	 * @param \stevotvr\groupsub\operator\unit_helper_interface  $unit_helper
	 * @param \phpbb\user                                        $user
	 */
	public function __construct(auth $auth, config $config, db_text $config_text, currency_interface $currency, helper $helper, language $language, package_interface $pkg_operator, request_interface $request, subscription_interface $sub_operator, template $template, unit_helper_interface $unit_helper, user $user, client_interface $stripe, log_interface $log)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->currency = $currency;
		$this->helper = $helper;
		$this->language = $language;
		$this->pkg_operator = $pkg_operator;
		$this->request = $request;
		$this->sub_operator = $sub_operator;
		$this->template = $template;
		$this->unit_helper = $unit_helper;
		$this->user = $user;
		$this->stripe = $stripe;
		$this->log = $log;
	}

	/**
	 * Set the phpBB installation path information.
	 *
	 * @param string $root_path The root phpBB path
	 * @param string $php_ext   The script file extension
	 */
	public function set_path_info($root_path, $php_ext)
	{
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * Handle the /groupsub/{name} route.
	 *
	 * @param string|null $name The unique identifier of a package
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function handle($name)
	{
		if (!$this->config['stevotvr_groupsub_active'] && !$this->auth->acl_get('a_'))
		{
			throw new http_exception(404, 'PAGE_NOT_FOUND');
		}

		if ($this->user->data['user_id'] == ANONYMOUS)
		{
			$u_redirect = $this->helper->route('stevotvr_groupsub_main', array('name' => $name));
			redirect(append_sid($this->root_path . 'ucp.' . $this->php_ext, 'mode=login&amp;redirect=' . $u_redirect));
		}

		add_form_key('stevotvr_groupsub_checkout');

		$this->template->assign_vars(array(
			'U_ACTION'	=> $this->helper->route('stevotvr_groupsub_main', array('name' => $name)),
		));

		$header_uid = $this->config['stevotvr_groupsub_header_bbcode_uid'];
		$header_bitfield = $this->config['stevotvr_groupsub_header_bbcode_bitfield'];
		$header_options = $this->config['stevotvr_groupsub_header_bbcode_options'];
		$header = generate_text_for_display($this->config_text->get('stevotvr_groupsub_header'), $header_uid, $header_bitfield, $header_options);

		$footer_uid = $this->config['stevotvr_groupsub_footer_bbcode_uid'];
		$footer_bitfield = $this->config['stevotvr_groupsub_footer_bbcode_bitfield'];
		$footer_options = $this->config['stevotvr_groupsub_footer_bbcode_options'];
		$footer = generate_text_for_display($this->config_text->get('stevotvr_groupsub_footer'), $footer_uid, $footer_bitfield, $footer_options);

		$this->template->assign_vars(array(
			'HEADER'	=> $header,
			'FOOTER'	=> $footer,
		));

		$term_id = $this->request->variable('term_id', 0);
		if ($term_id && $this->request->is_set_post('checkout'))
		{
			if (!check_form_key('stevotvr_groupsub_checkout'))
			{
				throw new http_exception(400, 'FORM_INVALID');
			}

			return $this->start_checkout($term_id);
		}

		return $this->list_packages($name);
	}

	/**
	 * Show the list of available packages.
	 *
	 * @param string|null $name The unique identifier of a package
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	protected function list_packages($name)
	{
		$packages = $this->pkg_operator->get_packages($name);

		if (empty($packages))
		{
			throw new http_exception(404, 'GROUPSUB_NO_PACKAGES');
		}

		$this->template->assign_var('COLLAPSE_TERMS', $this->config['stevotvr_groupsub_collapse_terms']);

		$subscriptions = $this->sub_operator->get_user_subscriptions($this->user->data['user_id']);
		$warn = $this->config['stevotvr_groupsub_warn_time'] * 86400;

		foreach ($packages as $package)
		{
			$can_buy = false;
			foreach ($package['terms'] as $term)
			{
				$can_buy = $can_buy || $this->is_checkout_term($term);
			}

			$vars = array(
				'ID'	=> $package['package']->get_id(),
				'NAME'	=> $package['package']->get_name(),
				'DESC'	=> $package['package']->get_desc_for_display(),
				'S_CAN_BUY' => $can_buy,
			);

			if (isset($subscriptions[$package['package']->get_id()]))
			{
				$expires = $subscriptions[$package['package']->get_id()]->get_expire();

				$vars = array_merge($vars, array(
					'S_ACTIVE'	=> true,
					'S_WARNING'	=> $expires && (($expires - time()) < $warn),

					'EXPIRES'	=> $expires ? $this->user->format_date($expires) : 0,
				));
			}

			$this->template->assign_block_vars('package', $vars);

			foreach ($package['terms'] as $term)
			{
				$this->template->assign_block_vars('package.term', array(
					'ID'		=> $term->get_id(),
					'PRICE'		=> $this->currency->format_price($term->get_currency(), $term->get_price()),
					'LENGTH'	=> $term->get_length() ? $this->unit_helper->get_formatted_timespan($term->get_length()) : 0,
				));
			}
		}

		return $this->helper->render('@stevotvr_groupsub/package_list.html', $this->language->lang('GROUPSUB_PACKAGE_LIST'));
	}

	/**
	 * Create a Stripe-hosted Checkout Session for a configured package term.
	 *
	 * @param int $term_id The term ID
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	protected function start_checkout($term_id)
	{
		$term = $this->pkg_operator->get_package_term($term_id);
		if (!$term)
		{
			throw new http_exception(404, 'PAGE_NOT_FOUND');
		}

		if (!$this->is_checkout_term($term['term']))
		{
			throw new http_exception(400, 'GROUPSUB_PLAN_INVALID');
		}

		$subscriptions = $this->sub_operator->get_user_subscriptions($this->user->data['user_id']);
		if (isset($subscriptions[$term['package']->get_id()]))
		{
			throw new http_exception(409, 'GROUPSUB_ALREADY_SUBSCRIBED');
		}

		if (!$this->stripe->is_configured())
		{
			throw new http_exception(503, 'GROUPSUB_STRIPE_NOT_CONFIGURED');
		}

		$payment_reference = 'TXN-' . gmdate('Ymd') . '-' . strtoupper(bin2hex(random_bytes(4)));
		$return_url = $this->helper->route('stevotvr_groupsub_return', array('term_id' => $term_id), true, false, UrlGeneratorInterface::ABSOLUTE_URL);
		$return_url .= (strpos($return_url, '?') === false ? '?' : '&')
			. 'reference=' . rawurlencode($payment_reference) . '&session_id={CHECKOUT_SESSION_ID}';
		$cancel_url = $this->helper->route('stevotvr_groupsub_main', array(), true, false, UrlGeneratorInterface::ABSOLUTE_URL);

		$user_id = (int) $this->user->data['user_id'];
		$metadata = array(
			'phpbb_user_id' => (string) $user_id,
			'groupsub_term_id' => (string) $term_id,
			'groupsub_reference' => $payment_reference,
		);
		$product_data = array(
			'name' => $term['package']->get_name(),
			'description' => 'Forum membership access',
		);
		$tax_code = getenv('STRIPE_TAX_CODE');
		if ($tax_code !== false && preg_match('/^txcd_\d+$/', trim($tax_code)))
		{
			$product_data['tax_code'] = trim($tax_code);
		}

		$params = array(
			'mode' => 'payment',
			'client_reference_id' => (string) $user_id,
			'customer_email' => $this->user->data['user_email'],
			'customer_creation' => 'always',
			'success_url' => $return_url,
			'cancel_url' => $cancel_url,
			'automatic_tax' => array('enabled' => 'true'),
			'billing_address_collection' => 'auto',
			'metadata' => $metadata,
			'payment_intent_data' => array(
				'description' => $term['package']->get_name() . ' - membership access',
				'receipt_email' => $this->user->data['user_email'],
				'metadata' => $metadata,
			),
			'line_items' => array(array(
				'quantity' => 1,
				'price_data' => array(
					'currency' => strtolower($term['term']->get_currency()),
					'unit_amount' => $term['term']->get_price(),
					'tax_behavior' => 'inclusive',
					'product_data' => $product_data,
				),
			)),
		);

		try
		{
			$session = $this->stripe->create_checkout_session($params);
		}
		catch (\RuntimeException $e)
		{
			$this->log->add('critical', $user_id, $this->user->data['user_ip'], 'LOG_GROUPSUB_STRIPE_CHECKOUT_ERROR', false, array($term_id, $e->getMessage()));
			throw new http_exception(503, 'GROUPSUB_STRIPE_UNAVAILABLE');
		}

		return new RedirectResponse($session['url'], 303);
	}

	/**
	 * A Checkout term must use a supported currency and have a positive price.
	 *
	 * @param \stevotvr\groupsub\entity\term_interface $term
	 * @return bool
	 */
	protected function is_checkout_term($term)
	{
		return $this->currency->is_valid($term->get_currency())
			&& $term->get_price() > 0;
	}
}
