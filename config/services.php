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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'luosimao'=>[
        // 'luosimaokey'=>'66b33e16fe0a42cc43c543acb0fe73b2',
	    // 'luosimao_verify'=>'https://captcha.luosimao.com/api/site_verify',
	    // 'luosimao_api_verify_key'=>'12811abff1b50a0d4af4bcd98bd3f97d',
        // 'luosimao_sms_key'=>'api:key-874d539f9686ff31bcec4987fc0e8698',
        'luosimao_sms_key'=>env('LUOSIMAO_SMS_KEY',''),
    ],
];
