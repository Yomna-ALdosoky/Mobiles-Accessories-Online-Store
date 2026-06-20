<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    private $apiKey;
    // protected $baseUrl;

    // protected $baseUrl = 'https://free.currconv.com/api/v8';
    protected $baseUrl = 'https://api.freecurrencyapi.com/v1/';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = env('CURRENCY_API_BASE_URL');

        // $this->baseUrl = config('services.currency.base_url');
    }

    // public function convert(string  $from, string $to, float $amount = 1)
    // {
    //     $q = "{$from}_{$to}";

    //     // $response = Http::baseUrl($this->baseUrl)
    //     //     ->get('/convert', [
    //     //         'q' => $q,
    //     //         'compact' => 'y',
    //     //         'apiKey' => $this->apiKey
    //     //     ]);
    //     $response = Http::baseUrl($this->baseUrl)
    //         ->get('latest', [
    //             'apikey'        => $this->apiKey,
    //             'base_currency' => $from,
    //             'currencies'    => $to,
    //         ]);

    //     $result = $response->json();

    //     $rate = $result['data'][$to] ?? 0;


    //     return $rate * $amount;
    // }

    public function convert(string $from, string $to, float $amount = 1)
    {
        // لو العملة المحول إليها هي نفسها عملة الأساس، رجعي السعر فوراً وو فري طلب الـ API
        if ($from === $to) {
            return $amount;
        }

        // هنادي على الـ API الجديد باستخدام الـ API Key بتاعك والـ Base Currency
        $url = "https://v6.exchangerate-api.com/v6/{$this->apiKey}/latest/{$from}";

        $response = Http::get($url);

        if ($response->successful()) {
            $result = $response->json();

            // الـ API الجديد بيبعت الأسعار كلها جوه الـ Array اللي اسمها conversion_rates
            $rate = $result['conversion_rates'][$to] ?? 1;

            return $rate * $amount;
        }

        // fallback لأي مشكلة طارئة في النت أو السيرفر عشان الموقع ميتعطلش
        return $amount;
    }
}
