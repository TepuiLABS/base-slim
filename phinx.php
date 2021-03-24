<?php

require_once __DIR__ . '/bootstrap/app.php';

return
[
    'paths' => [
        'migrations' => 'database/migrations',
    ],
	'migration_base_class' => 'App\Database\Migrations\Migration',
	'templates' => [
		'file' => 'app/Database/Migrations/MigrationStub.php'
	],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_environment' => 'default',
        'default' => [
            'adapter' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'name' => $_ENV['DB_DATABASE'],
            'user' => $_ENV['DB_USERNAME'],
            'pass' => $_ENV['DB_PASSWORD'],
            'port' => $_ENV['DB_PORT'],
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
        ],
    ],
    'version_order' => 'creation'
];
