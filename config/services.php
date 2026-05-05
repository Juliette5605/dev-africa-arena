<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
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
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Anthropic (Claude IA) Configuration
    |--------------------------------------------------------------------------
    */
    'anthropic' => [
        'key' => env('ANTHROPIC_API_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Google Gemini IA Configuration (Utilisé pour DevAfricaArena)
    |--------------------------------------------------------------------------
    */
    'gemini' => [
        'key' => env('GEMINI_API_KEY'),
    ],

];