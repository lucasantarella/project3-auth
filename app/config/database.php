<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

use Spiral\Database\Driver;

return [
    'default' => 'default',
    'databases' => [
        'default' => ['driver' => 'writer'],
//        'read_replica' => ['driver' => 'reader'],
    ],
    'aliases' => [
        'db' => 'default',
    ],
    'drivers' => [
        'writer' => [
            'driver' => Driver\MySQL\MySQLDriver::class,
            'connection' => "mysql:dbname=" . env('DB_NAME') . ";host=" . env('DB_HOST') . ";port=" . env('DB_PORT', 3306),
            'username' => env('DB_USER'),
            'password' => env('DB_PASS'),
        ],
    ]
];
