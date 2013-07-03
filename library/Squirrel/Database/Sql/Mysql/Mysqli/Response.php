<?php

namespace Squirrel\Database\Sql\Mysql\Mysqli;

use Squirrel\Database\Sql\ResponseInterface;
use Squirrel\Database\Sql\Exception\SqlException;

/**
 * Database response for mysqli.
 *
 * @package Squirrel\Database\Mysql\Mysqli
 * @author Valérian Galliat
 */
class Response implements ResponseInterface
{
    /**
     * @var mysqli_result
     */
    protected $result;

    /**
     * @param mysqli_result $result
     */
    public function __construct(\mysqli_result $result)
    {
        $this->result = $result;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return $this->result->num_rows;
    }

    /**
     * {@inheritdoc}
     */
    public function fetch()
    {
        return $this->result->fetch_assoc();
    }

    /**
     * {@inheritdoc}
     */
    public function fetchAll()
    {
        return $this->result->fetch_all(MYSQLI_ASSOC);
    }
}
