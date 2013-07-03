<?php

namespace Squirrel\Database\Sql\Pdo;

use Squirrel\Database\Sql\Database as SqlDatabase;
use Squirrel\Database\Sql\Exception\SqlException;

/**
 * Abstract database driver for PDO.
 *
 * @package Squirrel\Database\Pdo
 * @author Valérian Galliat
 */
abstract class Database extends SqlDatabase
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * Builds DSN and instanciates PDO object.
     *
     * @throws SqlException
     * @param string $dsn
     * @param string $user
     * @param string $pass
     */
    public function __construct($dsn, $user, $pass)
    {
        try {
            $this->pdo = new \PDO($dsn, $user, $pass);
        } catch (\PDOException $exception) {
            throw new SqlException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }

        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Deletes PDO instance.
     */
    public function __destruct()
    {
        unset($this->pdo);
    }

    /**
     * {@inheritdoc}
     */
    public function prepare($sql)
    {
        return new Request($this->pdo, $sql);
    }

    /**
     * {@inheritdoc}
     */
    public function getLastId()
    {
        try {
            return (integer) $this->pdo->lastInsertId();
        } catch (\PDOException $exception) {
            return 0;
        }
    }
}
