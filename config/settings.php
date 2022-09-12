<?php

// Should be set to 0 in production
error_reporting(E_ALL);

// Should be set to '0' in production
ini_set('display_errors', '1');

// Settings
$settings = [
    'api_key' => 'abc123',
    'user' => [
        'id' => 1,
        'email' => 'info@example.com',
        'password' => '12345678',
    ],
    'jwt' => [
        'secret' => '68V0zWFrS72GbpPreidkQFLfj4v9m3Ti+DXc8OB0gcM=',
        'alg' => 'HS256'
    ]
];

// ...

return $settings;