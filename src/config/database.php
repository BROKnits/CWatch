<?php
return [
    'db' => [
        'server' => 'YOUR_SERVER',
        'database' => 'Crypto',
        'username' => 'YOUR_USERNAME',
        'password' => 'YOUR_PASSWORD',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    ]
];