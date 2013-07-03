<?php

namespace Squirrel\Database\Sql\Mysql\Mysqli;

use Squirrel\Database\Sql\Database as SqlDatabase;
use Squirrel\Database\Sql\Exception\SqlException;

/**
 * Database driver for mysqli.
 *
 * @package Squirrel\Database\Mysql\Mysqli
 * @author Valérian Galliat
 */
class Database extends SqlDatabase
{
    /**
     * @var mysqli
     */
    protected $mysqli;

    /**
     * Instanciates mysqli object.
     *
     * @throws SqlException
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $db
     */
    public function __construct($host, $user, $pass, $db = null)
    {
        $mysqli = new mysqli($host, $user, $pass, $db);

        if (mysqli_connect_errno() !== 0) {
            throw new SqlException(
                mysqli_connect_error(),
                mysqli_connect_errno()
            );
        }

        $this->mysqli = $mysqli;
    }

    /**
     * Deletes mysqli instance.
     */
    public function __destruct()
    {
        unset($this->mysqli);
    }

    /**
     * {@inheritdoc}
     */
    public function prepare($sql)
    {
        return new Request($this->mysqli, $sql);
    }

    /**
     * {@inheritdoc}
     */
    public function getLastId()
    {
        return $this->mysqli->insert_id;
    }
}
