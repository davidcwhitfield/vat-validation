<?php

namespace Venditan\VAT\Adapter;

use Venditan\VAT\Response\NumberValidationResponse;

class Vies implements AdapterInterface
{
	protected $wsdl_url = 'http://ec.europa.eu/taxation_customs/vies/checkVatTestService.wsdl';
	protected $lastResponseHeaders = null;

	public function __construct($wsdl_url = null)
	{
		if ($wsdl_url !== null) {
			$this->setWsdlUrl($wsdl_url);
		}

		$this->setClient(new \SoapClient($this->getWsdlUrl(), ['trace' => 1]));
	}

	public function getWsdlUrl()
	{
		return $this->wsdl_url;
	}

	public function setWsdlUrl($wsdl_url)
	{
		$this->wsdl_url = $wsdl_url;
	}

	public function getClient()
	{
		return $this->client;
	}

	public function setClient($client)
	{
		$this->client = $client;
	}

	public function getLastResponseHeaders()
	{
		return $this->lastResponseHeaders;
	}

	public function setLastResponseHeaders($headers)
	{
		$this->lastResponseHeaders = $headers;
	}

	public function check($vatNumber, $countryCode) 
	{
		$details = [
			'vatNumber' => $vatNumber,
			'countryCode' => strtoupper($countryCode),
		];

		$soapResponse = $this->getClient()->checkVAT($details);

		$response = new NumberValidationResponse();
		$response->setCountryCode($countryCode);
		$response->setVatNumber($vatNumber);
		$response->setValid($soapResponse->valid);
		$response->setName($soapResponse->name);
		$response->setAddress($soapResponse->address);

		return $response;
	}
}
