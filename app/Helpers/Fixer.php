<?php
namespace App\Helpers;
use Cache;

class Fixer
{
    public static function getRate($base = 'JPY', $currency = 'AUD')
    {
        $url = config('apis.fixer.url');
        $key = config('apis.fixer.key');
        $url .= '?api_key=' . $key;
        $url .= '&from=' . $base;
        $url .= '&to=' . $currency;

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);
        return json_decode($response->getBody()->getContents());
    }


    public static function ratesFromCache()
    {
        $rates = (object)[];
        if (Cache::has('rates')) {
            $rates = Cache::get('rates');
        } else {
            $rateAud = self::getRate('AUD', 'USD');
            $rates->USD = $rateAud->amount;

            $rateUsd = self::getRate('AUD', 'JPY');
            $rates->JPY = $rateUsd->amount;
            Cache::put('rates', $rates, 60);
        }
        return $rates;
    }


}
