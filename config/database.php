<?php
return [
    'host' => getenv('DB_HOST', 'localhost'),
    'database' => getenv('DB_DATABASE', 'mercadolivre_seo'),
    'username' => getenv('DB_USERNAME', ''),
    'password' => getenv('DB_PASSWORD', ''),
    'charset' => 'utf8mb4'
];