<?php


namespace App\Marketplace\Utility;


use App\Marketplace\ModuleManager;
use Nwidart\Modules\Facades\Module;
use Symfony\Component\Intl\Intl;


/**
 * Wrapper around MultiCurrency Module
 *
 * Class CurrencyConverter
 * @package App\Marketplace\Utility
 */
class CurrencyConverter
{
    protected static $moduleName = 'MultiCurrency';

    /**
     * Converts value to local value
    */
    public static function convert($value, $from, $to) {
        if (!self::isEnabled()){
            return $value;
        }

        $converter = resolve('Modules\MultiCurrency\Converter');
        return round( $converter->convert($value, $from, $to), 2, PHP_ROUND_HALF_EVEN);

    }

    /**
     * Converts local value to USD value
     *
     * @param $localAmount
     * @param string $localValue
     * @return string
     */
    /*public static function convertToUsd($localAmount) {
        if (!self::isEnabled()) {
            return $localAmount;
        }

        $converter = resolve('Modules\MultiCurrencyModule\Converter');
        return round( $converter->convertFromLocal($localAmount, CurrencyConverter::getLocalCurrency()), 2, PHP_ROUND_HALF_EVEN);

    }*/

    public static function getSymbol($currency = null): string {
        if(empty($currency)){
            $currency = config('app.currency');
        }
	
        return Intl::getCurrencyBundle()->getCurrencySymbol($currency);
    }

    public static function getLocalCurrency() {
        if (!self::isEnabled()){
            return config('app.currency');
        }

        //$user = auth()->user();
        //if ($user == null) {
        //    return config('app.currency');
        //}

        if (session()->has('local_currency') and !empty(session()->get('local_currency'))){
            return session()->get('local_currency');
        }

        if(($user = auth()->user()) && !empty($user->currency)){
        	session()->put('local_currency',$user->currency);
       		return session()->get('local_currency');
        }

        return config('app.currency');
    }

    public static function convertToLocal($value, $currency = null) {
        if(empty($currency)){
            $currency = config('app.currency');
        }
        return self::convert($value, $currency, self::getLocalCurrency());
    }

    public static function getLocalSymbol() {
        return self::getSymbol(self::getLocalCurrency());
    }

    public static function isEnabled(): bool {
        return ModuleManager::isEnabled(self::$moduleName);
    }

    public static function getSupportedCurrencies() {
        if (!self::isEnabled()) {
            return [];
        }
        $converter = resolve('Modules\MultiCurrency\Converter');

        return $converter->getSupportedCurrencies();
    }
}
