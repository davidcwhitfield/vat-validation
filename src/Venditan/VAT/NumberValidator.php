<?php

namespace Venditan\VAT;

use League\ISO3166\ISO3166;
use Venditan\VAT\Adapter\AdapterInterface;

class NumberValidator implements ValidatorInterface
{
	protected $adapter = null;

	public function __construct(AdapterInterface $adapter)
	{
		$this->adapter = $adapter;
	}

	public function checkVATNumber($vatNumber, $countryCode)
	{
		$countryCode = $this->formatCountryCode($countryCode);

		if (strpos($countryCode, $vatNumber) === 0) {
			$vatNumber = substr($countryCode, strlen($countrCode));
		}

		// This is wrapped in a try catch block in case VIES is unavailable
		try {
			$data = $this->adapter->check($vatNumber, $countryCode);
			$resData = $this->adapter->getLastResponseHeaders();
			var_dump($data);
			var_dump($resData);
			return $data;
		} catch (\Exception $e) {
			return null;
		}
	}

	public function formatCountryCode($countryCode, $format = ISO3166::KEY_ALPHA2)
	{
		$iso3166 = new ISO3166();

		$countryData = [];

		if (is_numeric($countryCode)) {
			$countryData = $iso3166->numeric((string)$countryCode);
		} else {
			switch (strlen($countryCode)) {
				case 3:
					$countryData = $iso3166->alpha3($countryCode);
					break;
				case 2:
				default:
					$countryData = $iso3166->alpha2($countryCode);
			}
		}

		if (empty($countryData)) {
			return $countryCode;
		}

		return $countryData[$format];
	}
}
