<?php
 /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */
/*
return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
*/

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // Cambiar '*' por el dominio específico de tu aplicación front-end
    'allowed_origins' => ['http://localhost:4200'],
    //'allowed_origins' => ['http://localhost', 'http://localhost:3000', 'http://127.0.0.1:8000'],


    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

   // 'exposed_headers' => [],

    'max_age' => 0,

    // Habilitar credenciales
    'supports_credentials' => true,

];

