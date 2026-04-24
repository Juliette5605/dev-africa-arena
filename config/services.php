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
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | IA Orientation - DevAfricaArena Configuration
    |--------------------------------------------------------------------------
    | Ces réglages permettent de connecter l'application à l'API d'IA.
    | Les valeurs réelles sont stockées en toute sécurité dans le fichier .env
    */

    'ia' => [
        'url'   => env('IA_SERVICE_URL', 'https://api.openai.com/v1/chat/completions'),
        'key'   => env('IA_API_KEY'),
        'model' => env('IA_MODEL', 'gpt-4-turbo'),
    ],

];
