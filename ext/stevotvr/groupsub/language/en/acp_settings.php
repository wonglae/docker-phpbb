<?php
/**
 *
 * Group Subscription. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Steve Guidetti, https://github.com/stevotvr
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_GROUPSUB_SETTINGS_TITLE'			=> 'Group Subscription settings',
	'ACP_GROUPSUB_SETTINGS_SAVED'			=> 'Group Subscription options saved successfully',
	'ACP_GROUPSUB_SETTINGS_STRIPE'			=> 'Stripe Checkout',
	'ACP_GROUPSUB_ACTIVE'					=> 'Enable payments',
	'ACP_GROUPSUB_ACTIVE_EXPLAIN'			=> 'Show packages and allow members to start Stripe Checkout.',
	'ACP_GROUPSUB_STRIPE_SECRETS'			=> 'Server credentials',
	'ACP_GROUPSUB_STRIPE_SECRETS_EXPLAIN'	=> 'Secrets entered here are stored in the phpBB database. Environment variables are used only when a database value has not been saved.',
	'ACP_GROUPSUB_STRIPE_SECRET_KEY'		=> 'Stripe secret key',
	'ACP_GROUPSUB_STRIPE_WEBHOOK_SECRET'	=> 'Stripe webhook signing secret',
	'ACP_GROUPSUB_STRIPE_SECRET_SAVED'		=> 'A value is saved. Leave this field blank to keep it unchanged.',
	'ACP_GROUPSUB_STRIPE_SECRET_NOT_SAVED'	=> 'No value is saved. Enter a value to configure it.',
	'ACP_GROUPSUB_STRIPE_CONFIGURED'		=> 'Both Stripe secrets are configured.',
	'ACP_GROUPSUB_STRIPE_NOT_CONFIGURED'	=> 'Stripe secrets are missing or invalid.',
	'ACP_GROUPSUB_STRIPE_MODE'				=> 'API mode',
	'ACP_GROUPSUB_STRIPE_TEST'				=> 'Test',
	'ACP_GROUPSUB_STRIPE_LIVE'				=> 'Live',
	'ACP_GROUPSUB_SETTINGS_GENERAL'			=> 'General options',
	'ACP_GROUPSUB_NOTIFY_ADMINS'			=> 'Notify admins',
	'ACP_GROUPSUB_NOTIFY_ADMINS_EXPLAIN'	=> 'If enabled, administrators with the <em>“Can view users’ subscriptions”</em> permission will be notified of all new subscriptions.',
	'ACP_GROUPSUB_HEADER'					=> 'Page header',
	'ACP_GROUPSUB_HEADER_EXPLAIN'			=> 'Information to display at the top of all subscription pages.',
	'ACP_GROUPSUB_FOOTER'					=> 'Page footer',
	'ACP_GROUPSUB_FOOTER_EXPLAIN'			=> 'Information to display at the bottom of all subscription pages.',
	'ACP_GROUPSUB_COLLAPSE_TERMS'			=> 'Collapse terms list',
	'ACP_GROUPSUB_COLLAPSE_TERMS_EXPLAIN'	=> 'The list of terms for a package will be listed in a select box if there are more than this many options.',
	'ACP_GROUPSUB_SETTINGS_DEFAULTS'		=> 'Package defaults',
	'ACP_GROUPSUB_DEFAULT_CURRENCY'			=> 'Default currency',
	'ACP_GROUPSUB_DEFAULT_CURRENCY_EXPLAIN'	=> 'This is the default currency for all new packages, which can be overridden on a per-package basis.',
	'ACP_GROUPSUB_WARN_TIME'				=> 'Warning time',
	'ACP_GROUPSUB_WARN_TIME_EXPLAIN'		=> 'The number of days before the expiration of a subscription to notify the subscriber.',
	'ACP_GROUPSUB_GRACE'					=> 'Grace period',
	'ACP_GROUPSUB_GRACE_EXPLAIN'			=> 'The number of days after a subscription ends before removing the user from groups.',

	'ACP_GROUPSUB_ERROR_CURRENCY'	=> 'You must select a valid currency.',
	'ACP_GROUPSUB_ERROR_STRIPE_SECRET_KEY' => 'The Stripe secret key must start with sk_test_, sk_live_, rk_test_, or rk_live_.',
	'ACP_GROUPSUB_ERROR_STRIPE_WEBHOOK_SECRET' => 'The Stripe webhook signing secret must start with whsec_.',
	'ACP_GROUPSUB_ERROR_STRIPE_CONFIG' => 'Payments cannot be enabled until both Stripe secrets are configured.',
));
