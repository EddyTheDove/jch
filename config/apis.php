<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'fixer' => [
        'url' => "https://www.amdoren.com/api/currency.php",
        'key' => env('AMDOREM_KEY', '')
    ],

    'avto' => [
        'url' => "http://75.125.226.218/xml/json",
        'code' => env('AVTO_CODE')
    ],

];
