<?php

namespace Squirrel\Database\Sql\Mysql\Pdo;

use Squirrel\Database\Sql\Pdo\Database as PdoDatabase;

/**
 * Database driver for MySQL PDO.
 *
 * @package Squirrel\Database\Mysql\Pdo
 * @author Valérian Galliat
 */
class Database extends PdoDatabase
{
    /**
     * Builds DSN and instanciates PDO object.
     *
     * @throws \Squirrel\Database\Sql\Exception\SqlException
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $db
     */
    public function __construct($host, $user, $pass, $db = null)
    {
        $dsn = 'mysql:host=' . $host;

        if (isset($db)) {
            $dsn .= '; dbname=' . $db;
        }

        parent::__construct($dsn, $user, $pass);
    }
}
