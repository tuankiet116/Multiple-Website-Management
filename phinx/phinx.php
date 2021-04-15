<?php

require __DIR__ . '/../classes/config_database.php';

return
[
    'paths'        => [
      'migrations' => '%%PHINX_CONFIG_DIR%%/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/seeds',
    ],
    'environments' =>
    [
        'default_database'        => 'production',
        'default_migration_table' => 'phinxlog',
        'production'              => [
            'adapter'   => 'mysql',
            'host'      => DATABASE_HOST,
            'name'      => DATABASE_NAME,
            'user'      => DATABASE_USERNAME,
            'pass'      => DATABASE_PASSWORD,
            'port'      => 3306,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ],
];
