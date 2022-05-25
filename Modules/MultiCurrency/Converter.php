<?php

namespace Modules\MultiCurrencyModule;

use Illuminate\Support\Facades\Cache;

require '../vendor/autoload.php';

use AmrShawky\Currency;

class Converter{
	public function convert($value, $currency, $localCurrency){
		if($currency == $localCurrency){
			return $value;
		}
		
		/*return Currency::convert()
		->from($currency)
		->to($localCurrency)
		->amount($value)
		->get();*/
		
		$rate = Cache::remember('multicurrency:'.$currency.":to:".$localCurrency,600,function() use($currency,$localCurrency){
			return Currency::convert()->from($currency)
				   ->to($localCurrency)
				   ->get();
		});
		
		return $value*$rate;
	}
}
