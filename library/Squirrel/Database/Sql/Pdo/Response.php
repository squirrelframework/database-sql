<?php

namespace Squirrel\Database\Sql\Pdo;

use Squirrel\Database\Sql\ResponseInterface;
use Squirrel\Database\Sql\Exception\SqlException;

/**
 * Database response for PDO.
 *
 * @package Squirrel\Database\Pdo
 * @author Valérian Galliat
 */
class Response implements ResponseInterface
{
    /**
     * @var PDOStatement
     */
    protected $statement;

    /**
     * @param PDOStatement $statement
     */
    public function __construct(\PDOStatement $statement)
    {
        $this->statement = $statement;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return $this->statement->rowCount();
    }

    /**
     * {@inheritdoc}
     */
    public function fetch()
    {
        try {
            $result = $this->statement->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            return null;
        }

        if ($result === false) {
            return null;
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function fetchAll()
    {
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
