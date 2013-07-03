<?php

namespace Squirrel\Database\Sql\Pdo;

use Squirrel\Database\Sql\Request as SqlRequest;
use Squirrel\Database\Sql\Exception\SqlException;

/**
 * Database request for PDO.
 *
 * @package Squirrel\Database\Pdo
 * @author Valérian Galliat
 */
class Request extends SqlRequest
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @param PDO $pdo
     * @param string $sql
     */
    public function __construct($pdo, $sql)
    {
        parent::__construct($sql);
        $this->pdo = $pdo;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $sql = $this->compile();

        try {
            $statement = $this->pdo->query($sql);
        } catch (\PDOException $exception) {
            throw new SqlException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }

        return new Response($statement);
    }
}
