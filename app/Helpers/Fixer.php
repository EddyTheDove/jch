<?php
namespace App\Helpers;
use Cache;

class Fixer
{
    public static function getRate($base = 'AUD', $currency = ['USD'])
    {
        $url = config('apis.fixer.url');
        $url .= '/latest?base=' . $base;

        $symbols = implode($currency, ',');
        $url .= '&symbols=' . $symbols;

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);
        return json_decode($response->getBody()->getContents());
    }


    public static function rateFromCache()
    {
        $rate = 0;
        if (Cache::has('rate')) {
            $rate = Cache::get('rate');
        } else {
            $rate = Cache::remember('rate', 60, function () {
                $item = Self::getRate();
                return $item->rates->AUD;
            });
        }
    }

    public static function ratesFromCache()
    {
        $rates = [];
        if (Cache::has('rates')) {
            $rates = Cache::get('rates');
        } else {
            $rates = Cache::remember('rates', 60, function () {
                $item = Self::getRate('AUD', ['USD', 'JPY', 'PKR']);
                return $item->rates;
            });
        }
        return $rates;
    }
}
