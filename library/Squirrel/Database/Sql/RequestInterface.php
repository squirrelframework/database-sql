<?php

namespace Squirrel\Database\Sql;

/**
 * Interface for all database requests.
 *
 * @package Squirrel\Database\Sql
 * @author Valérian Galliat
 */
interface RequestInterface
{
    /**
     * Binds an identifier with backticks in request.
     *
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function bindIdentifier($name, $value);

    /**
     * Binds a value with simple quotes in request.
     *
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function bindValue($name, $value);

    /**
     * Executes current request and returns the server response.
     *
     * @throws Exception\SqlException
     * @return ResponseInterface|true
     */
    public function execute();
}
