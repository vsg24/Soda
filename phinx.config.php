<?php
require_once 'app.config.php';
return [
    'paths' => [
        'migrations' => 'db/migrations'
    ],
    'migration_base_class' => '\App\Migration\Migration',
    'environments' => [
        'default_migration_table' => '_db_migrations_log',
        'default_database' => 'dev',
        'dev' => [
            'adapter' => SQL_DB_DRIVER_TYPE,
            'host' => SQL_DB_HOST,
            'name' => SQL_DB_DEFAULT_NAME,
            'user' => SQL_DB_USERNAME,
            'pass' => SQL_DB_PASSWORD,
            'port' => SQL_DB_PORT
        ]
      ]
];