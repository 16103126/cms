<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '576506575164-9gd79ci6gv2b7qgh0ec8r41lr7abn83u.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/wallet/user/login/google/callback'
    ],

    'facebook' => [
        'client_id' => '1377377443019890',
        'client_secret' => '4218d3763ae8ccb8b40118af58e64f57',
        'redirect' => 'http://localhost/wallet/user/login/facebook/callback',
    ],
];
