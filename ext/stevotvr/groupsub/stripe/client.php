<?php
/**
 * Minimal Stripe Checkout client.
 *
 * The extension only needs one Stripe API operation. Keeping this adapter small
 * avoids shipping a second Composer tree inside phpBB while retaining signed,
 * server-side requests and verified webhook delivery.
 *
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace stevotvr\groupsub\stripe;

use phpbb\config\db_text;

class client implements client_interface
{
	const CHECKOUT_SESSIONS_URI = 'https://api.stripe.com/v1/checkout/sessions';
	const WEBHOOK_TOLERANCE = 300;
	const SECRET_KEY_CONFIG = 'STRIPE_SECRET_KEY';
	const WEBHOOK_SECRET_CONFIG = 'STRIPE_WEBHOOK_SECRET';

	/** @var \phpbb\config\db_text */
	protected $config_text;

	public function __construct(db_text $config_text)
	{
		$this->config_text = $config_text;
	}

	/** @return string */
	public function get_secret_key()
	{
		$value = trim((string) $this->config_text->get(self::SECRET_KEY_CONFIG));
		if ($value !== '')
		{
			return $value;
		}

		$value = getenv('STRIPE_SECRET_KEY');
		return $value === false ? '' : trim($value);
	}

	/** @return string */
	public function get_webhook_secret()
	{
		$value = trim((string) $this->config_text->get(self::WEBHOOK_SECRET_CONFIG));
		if ($value !== '')
		{
			return $value;
		}

		$value = getenv('STRIPE_WEBHOOK_SECRET');
		return $value === false ? '' : trim($value);
	}

	/** @inheritDoc */
	public function is_valid_secret_key($value)
	{
		return preg_match('/^(sk|rk)_(test|live)_/', trim((string) $value)) === 1;
	}

	/** @inheritDoc */
	public function is_valid_webhook_secret($value)
	{
		return strpos(trim((string) $value), 'whsec_') === 0;
	}

	/** @inheritDoc */
	public function is_configured()
	{
		return $this->is_valid_secret_key($this->get_secret_key())
			&& $this->is_valid_webhook_secret($this->get_webhook_secret());
	}

	/** @inheritDoc */
	public function is_test_mode()
	{
		return preg_match('/^(sk|rk)_test_/', $this->get_secret_key()) === 1;
	}

	/** @inheritDoc */
	public function create_checkout_session(array $params)
	{
		$key = $this->get_secret_key();
		if (!preg_match('/^(sk|rk)_(test|live)_/', $key))
		{
			throw new \RuntimeException('Stripe is not configured.');
		}

		$body = http_build_query($params, '', '&', PHP_QUERY_RFC3986);
		$response = $this->post(self::CHECKOUT_SESSIONS_URI, $body, array(
			'Authorization: Bearer ' . $key,
			'Content-Type: application/x-www-form-urlencoded',
		));

		$data = json_decode($response['body'], true);
		if ($response['status'] < 200 || $response['status'] >= 300 || !is_array($data))
		{
			$message = isset($data['error']['message']) ? $data['error']['message'] : 'Stripe Checkout request failed.';
			throw new \RuntimeException($message);
		}

		if (empty($data['id']) || empty($data['url']))
		{
			throw new \RuntimeException('Stripe returned an incomplete Checkout Session.');
		}

		return $data;
	}

	/** @inheritDoc */
	public function construct_webhook_event($payload, $signature)
	{
		$secret = $this->get_webhook_secret();
		if ($secret === '' || $payload === '' || $signature === '')
		{
			return false;
		}

		$timestamp = 0;
		$signatures = array();
		foreach (explode(',', $signature) as $part)
		{
			$pair = explode('=', trim($part), 2);
			if (count($pair) !== 2)
			{
				continue;
			}
			if ($pair[0] === 't')
			{
				$timestamp = (int) $pair[1];
			}
			elseif ($pair[0] === 'v1')
			{
				$signatures[] = $pair[1];
			}
		}

		if (!$timestamp || abs(time() - $timestamp) > self::WEBHOOK_TOLERANCE)
		{
			return false;
		}

		$expected = hash_hmac('sha256', $timestamp . '.' . $payload, $secret);
		$valid = false;
		foreach ($signatures as $candidate)
		{
			if (hash_equals($expected, $candidate))
			{
				$valid = true;
				break;
			}
		}
		if (!$valid)
		{
			return false;
		}

		$event = json_decode($payload, true);
		if (!is_array($event) || empty($event['id']) || empty($event['type'])
			|| !isset($event['livemode']) || !isset($event['data']['object']))
		{
			return false;
		}

		return $event;
	}

	/**
	 * @return array Array containing HTTP status and response body
	 */
	protected function post($url, $body, array $headers)
	{
		if (function_exists('curl_init'))
		{
			$ch = curl_init($url);
			if ($ch === false)
			{
				throw new \RuntimeException('Unable to initialize cURL.');
			}

			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			$response_body = curl_exec($ch);
			$status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$error = curl_error($ch);
			curl_close($ch);

			if ($response_body === false)
			{
				throw new \RuntimeException('Stripe connection failed: ' . $error);
			}

			return array('status' => $status, 'body' => $response_body);
		}

		$context = stream_context_create(array('http' => array(
			'method' => 'POST',
			'header' => implode("\r\n", $headers),
			'content' => $body,
			'timeout' => 30,
			'ignore_errors' => true,
		)));
		$response_body = @file_get_contents($url, false, $context);
		if ($response_body === false)
		{
			throw new \RuntimeException('Stripe connection failed.');
		}

		$status = 0;
		if (isset($http_response_header[0]) && preg_match('/\s(\d{3})\s/', $http_response_header[0], $matches))
		{
			$status = (int) $matches[1];
		}

		return array('status' => $status, 'body' => $response_body);
	}
}
