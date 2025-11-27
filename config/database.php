<?php

return [

//    'default' => env('DB_CONNECTION', 'sqlite'),


    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        // --- Monitor PostgreSQL ---
        'pgsql_monitor' => [
            'driver' => 'pgsql',
            'host' => env('PG_MONITOR_HOST'),
            'port' => env('PG_MONITOR_PORT'),
            'database' => env('PG_MONITOR_DB'),
            'username' => env('PG_MONITOR_USER'),
            'password' => env('PG_MONITOR_PASS'),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        // --- Pohoda MSSQL ---
        'sqlsrv_pohoda' => [
            'driver' => 'sqlsrv',
            'host' => env('POHODA_HOST'),
            'port' => env('POHODA_PORT'),
            'database' => env('POHODA_DB'),
            'username' => env('POHODA_USER'),
            'password' => env('POHODA_PASS'),
            'charset' => 'utf8',
            'prefix' => '',
        ],


    ],

    'default' => env('DB_CONNECTION', 'pgsql_monitor'),

];
