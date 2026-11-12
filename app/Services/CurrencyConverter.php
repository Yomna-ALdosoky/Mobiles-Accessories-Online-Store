<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    private $apiKey;

    protected $baseUrl = 'https://api.freecurrencyapi.com/v1/';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = env('CURRENCY_API_BASE_URL');
    }

    public function convert(string $from, string $to, float $amount = 1)
    {
        if ($from === $to) {
            return $amount;
        }

        $url = "https://v6.exchangerate-api.com/v6/{$this->apiKey}/latest/{$from}";

        $response = Http::get($url);

        if ($response->successful()) {
            $result = $response->json();

            $rate = $result['conversion_rates'][$to] ?? 1;

            return $rate * $amount;
        }

        return $amount;
    }
}
