<?php

namespace Squirrel\Database\Sql\Mysql\Mysql;

use Squirrel\Database\Sql\ResponseInterface;
use Squirrel\Database\Sql\Exception\SqlException;

/**
 * Database response for MySQL PHP functions.
 *
 * @package Squirrel\Database\Mysql\Mysql
 * @author Valérian Galliat
 */
class Response implements ResponseInterface
{
    /**
     * @var resource
     */
    protected $result;

    /**
     * @param resource $result
     */
    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return \mysql_num_rows($this->result);
    }

    /**
     * {@inheritdoc}
     */
    public function fetch()
    {
        $result = \mysql_fetch_assoc($this->result);

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
        $rows = array();
        $row = $this->fetch();

        while ($row !== false) {
            $rows[] = $row;
            $row = $this->fetch();
        }

        return $rows;
    }
}
