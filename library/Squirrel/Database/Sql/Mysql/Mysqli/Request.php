<?php

namespace Squirrel\Database\Sql\Mysql\Mysqli;

use Squirrel\Database\Sql\Request as SqlRequest;
use Squirrel\Database\Sql\Exception\SqlException;

/**
 * Database request for mysqli.
 *
 * @package Squirrel\Database\Mysql\Mysqli
 * @author Valérian Galliat
 */
class Request extends SqlRequest
{
    /**
     * @var mysqli
     */
    protected $mysqli;

    /**
     * @param mysqli $mysqli
     * @param string $sql
     */
    public function __construct($mysqli, $sql)
    {
        parent::__construct($sql);
        $this->mysqli = $mysqli;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $sql = $this->compile();
        $result = $this->mysqli->query($sql);
        return new Response($result);
    }
}
