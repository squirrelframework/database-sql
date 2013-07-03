<?php

namespace Squirrel\Database\Sql;

/**
 * Interface for all database responses.
 *
 * @package Squirrel\Database\Sql
 * @author Valérian Galliat
 */
interface ResponseInterface
{
    /**
     * Gets the count of the result.
     *
     * @return integer
     */
    public function count();
    
    /**
     * Gets the next result's row.
     *
     * @return array|null
     */
    public function fetch();

    /**
     * Gets all result's rows.
     *
     * @return array
     */
    public function fetchAll();
}
