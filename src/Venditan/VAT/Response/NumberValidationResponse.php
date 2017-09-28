<?php

namespace Venditan\VAT\Response;

class NumberValidationResponse implements ResponseInterface
{
	protected $countryCode;
	protected $vatNumber;
	protected $requestDate;
	protected $valid;
	protected $name;
	protected $address;

	public function isValid()
	{
		echo "Checking valid\n";
		return (isset($this->valid) && $this->valid === true) ? true : false;
	}

	public function setValid($valid)
	{
		$this->valid = $valid;
		return $this;
	}

	public function getCountryCode()
	{
		return $this->countryCode;
	}

	public function setCountryCode($countryCode)
	{
		$this->countryCode = $countryCode;
		return $this;
	}

	public function getVatNumber()
	{
		return $this->countryCode;
	}

	public function setVatNumber($vatNumber)
	{
		$this->vatNumber = $vatNumber;
		return $this;
	}

	public function getRequestDate()
	{
		return $this->requestDate;
	}

	public function setRequestDate($requestDate)
	{
		$this->requestDate = $requestDate;
		return $this;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress($address)
	{
		$this->address = $address;
		return $this;
	}
}
