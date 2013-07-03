<?php

namespace Squirrel\Database\Sql;

/**
 * Interface for all database drivers.
 *
 * @package Squirrel\Database\Sql
 * @author Valérian Galliat
 */
interface DatabaseInterface
{
    /**
     * Preforms given SQL query and returns the server response.
     *
     * @throws Exception\SqlException
     * @param string $sql
     * @return ResponseInterface
     */
    public function query($sql);

    /**
     * Prepares given SQL query and returns a database
     * request allowing to bind parameters and to execute the query.
     *
     * @throws Exception\SqlException
     * @param string $sql
     * @return RequestInterface
     */
    public function prepare($sql);

    /**
     * Gets last inserted identifier in the database.
     *
     * @return integer
     */
    public function getLastId();
}
