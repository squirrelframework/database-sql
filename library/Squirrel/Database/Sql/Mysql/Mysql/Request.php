<?php

namespace Squirrel\Database\Sql\Mysql\Mysql;

use Squirrel\Database\Sql\Request as SqlRequest;
use Squirrel\Database\Sql\Exception\SqlException;

/**
 * Database request for MySQL PHP functions.
 *
 * @package Squirrel\Database\Mysql\Mysql
 * @author Valérian Galliat
 */
class Request extends SqlRequest
{
    /**
     * @var resource
     */
    protected $connection;

    /**
     * @param resource $connection
     * @param string $sql
     */
    public function __construct($connection, $sql)
    {
        parent::__construct($sql);
        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $sql = $this->compile();
        $result = \mysql_query($sql, $this->connection);

        if ($result === false) {
            throw new SqlException(
                \mysql_error(),
                \mysql_errno()
            );
        }

        if ($result === true) {
            return true;
        }
        
        return new Response($result);
    }
}
