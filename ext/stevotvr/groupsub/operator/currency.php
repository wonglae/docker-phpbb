<?php
/**
 *
 * Group Subscription. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, Steve Guidetti, https://github.com/stevotvr
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace stevotvr\groupsub\operator;

use stevotvr\groupsub\exception\unexpected_value;

/**
 * Group Subscription currency operator.
 */
class currency extends operator implements currency_interface
{
	/**
	 * @inheritDoc
	 */
	public function get_currencies()
	{
		return $this->currencies;
	}

	/**
	 * @inheritDoc
	 */
	public function format_value($currency_code, $value, $with_separator = false, $localized = true)
	{
		$value = (int) $value;

		$this->validate($currency_code);
		$currency = $this->currencies[$currency_code];

		$unit = (int) ($value / $currency['subunit_to_unit']);
		$subunit = $value % $currency['subunit_to_unit'];

		if ($with_separator)
		{
			$unit = number_format($unit, 0, '', $localized ? $this->language->lang('GROUPSUB_THOUSANDS_SEPARATOR') : ',');
		}

		return sprintf('%s%s%02d', $unit, $localized ? $this->language->lang('GROUPSUB_DECIMAL_SEPARATOR') : '.', $subunit);
	}

	/**
	 * @inheritDoc
	 */
	public function format_price($currency_code, $value)
	{
		$this->validate($currency_code);
		$currency = $this->currencies[$currency_code];

		$format = $currency['symbol_first'] ? '%s%s&nbsp;%s' : '%2$s%1$s&nbsp;%3$s';
		$amount = $this->format_value($currency_code, $value, true);

		return sprintf($format, $currency['symbol'], $amount, $currency_code);
	}

	/**
	 * @inheritDoc
	 */
	public function parse_value($currency_code, $value)
	{
		$this->validate($currency_code);
		$currency = $this->currencies[$currency_code];

		$decimal_separator = $this->language->lang('GROUPSUB_DECIMAL_SEPARATOR');
		$thousands_separator = $this->language->lang('GROUPSUB_THOUSANDS_SEPARATOR');

		$parts = explode($decimal_separator, $value, 2);

		if (!preg_match('/^[\d\\' . $thousands_separator . ']*$/', $parts[0]))
		{
			throw new unexpected_value('value');
		}

		$unit = (int) str_replace($thousands_separator, '', $parts[0]);
		$subunit = 0;

		if (count($parts) > 1)
		{
			$subunit = str_pad($parts[1], 2, '0');
			if (strlen($subunit) > 2)
			{
				throw new unexpected_value('value');
			}

			$subunit = (int) $subunit;
		}

		return ($unit * $currency['subunit_to_unit']) + $subunit;
	}

	/**
	 * @inheritDoc
	 */
	public function is_valid($currency_code)
	{
		return isset($this->currencies[$currency_code]);
	}

	/**
	 * Validate a currency code.
	 *
	 * @param string $currency_code The currency code to validate
	 *
	 * @throws \stevotvr\groupsub\exception\unexpected_value
	 */
	protected function validate($currency_code)
	{
		if (!$this->is_valid($currency_code))
		{
			throw new unexpected_value('currency_code');
		}
	}
}
