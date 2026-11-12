<?php

// namespace App\Helpers;

// use NumberFormatter;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Currency
{

    public function __invoke(...$params)
    {
        return static::format(...$params);
    }

    public static function format($amount, $currency = null)
    {
        $baseCurrency = config('app.currency', 'USD');

        if ($currency === null) {
            $currency = Session::get('currency_code', $baseCurrency);
        }
        if ($currency != $baseCurrency) {
            $rate = Cache::get('currency_rate_' . $currency, 1);
            $amount = $amount * $rate;
        }

        $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($amount, $currency);
    }
}
