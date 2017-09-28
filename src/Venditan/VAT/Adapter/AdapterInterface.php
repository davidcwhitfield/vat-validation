<?php

namespace Venditan\VAT\Adapter;

interface AdapterInterface {
	public function check($vatNumber, $iso2CountryCode);
}
