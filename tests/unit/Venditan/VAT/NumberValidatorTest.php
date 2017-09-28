<?php

namespace Venditan\VAT\Tests;

use PHPUnit\Framework\TestCase;
use Venditan\VAT\NumberValidator;
use League\ISO3166\ISO3166;

class NumberValidatorTest extends TestCase
{
	public function validCountryCodeProvider()
	{
		return [
			['GB', ISO3166::KEY_ALPHA2, 'GB'],
			['GRC', ISO3166::KEY_ALPHA2, 'GR'],
			['716', ISO3166::KEY_ALPHA2, 'ZW'],
			['EE', ISO3166::KEY_ALPHA3, 'EST'],
			['HKG', ISO3166::KEY_ALPHA3, 'HKG'],
			[400, ISO3166::KEY_ALPHA3, 'JOR'],
			['LR', ISO3166::KEY_NUMERIC, 430],
			['NOR', ISO3166::KEY_NUMERIC, 578],
			['124', ISO3166::KEY_NUMERIC, 124],
		];
	}

	/**
	 * @dataProvider validCountryCodeProvider
	 */
	public function testCountryCodeFormatter($countryCode, $format, $expectedFormattedCode)
	{
		$mockAdapter = $this->getMockBuilder(\Venditan\VAT\Adapter\AdapterInterface::class)->getMock();
		$numberValidator = new NumberValidator($mockAdapter);
		$countryCode = $numberValidator->formatCountryCode($countryCode, $format);
		$this->assertEquals($countryCode, $expectedFormattedCode);
	}
}
