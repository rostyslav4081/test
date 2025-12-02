<?php

return [

    'connections' => [

        // --- DEFAULT PGSQL ---
        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        // --- MONITOR PGSQL ---
        'pgsql_monitor' => [
            'driver' => 'pgsql',
            'url' => env('MONITOR_DB_URL'),
            'host' => env('MONITOR_DB_HOST', '127.0.0.1'),
            'port' => env('MONITOR_DB_PORT', '5432'),
            'database' => env('MONITOR_DB_DATABASE', 'monitor'),
            'username' => env('MONITOR_DB_USERNAME', 'monitor'),
            'password' => env('MONITOR_DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

    ],

];
