<?php

namespace Squirrel\Database\Sql\Mysql\Mysql;

use Squirrel\Database\Sql\Database as SqlDatabase;
use Squirrel\Database\Sql\Exception\SqlException;

/**
 * Database driver for MySQL PHP functions.
 *
 * @package Squirrel\Database\Mysql\Mysql
 * @author Valérian Galliat
 */
class Database extends SqlDatabase
{
    /**
     * @var resource
     */
    protected $connection;

    /**
     * Connects to the SQL server and optionally selects given database.
     *
     * @throws SqlException
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $db
     */
    public function __construct($host, $user, $pass, $db = null)
    {
        $connection = \mysql_connect($host, $user, $pass);

        if ($connection === false) {
            throw new SqlException(
                \mysql_error(),
                \mysql_errno()
            );
        }

        $this->connection = $connection;

        if ($db === null) {
            return;
        }

        $result = \mysql_select_db($db, $this->connection);

        if ($result === false) {
            throw new SqlException(
                \mysql_error(),
                \mysql_errno()
            );
        }
    }

    /**
     * Closes the connection.
     */
    public function __destruct()
    {
        \mysql_close($this->connection);
    }

    /**
     * {@inheritdoc}
     */
    public function prepare($sql)
    {
        return new Request($this->connection, $sql);
    }

    /**
     * {@inheritdoc}
     */
    public function getLastID()
    {
        return \mysql_insert_id($this->connection);
    }
}
