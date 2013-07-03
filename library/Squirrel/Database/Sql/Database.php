<?php

namespace Squirrel\Database\Sql;

/**
 * Abstract database driver.
 *
 * @package Squirrel\Database\Sql
 * @author Valérian Galliat
 */
abstract class Database implements DatabaseInterface
{
    /**
     * {@inheritdoc}
     */
    public function query($sql)
    {
        return $this->prepare($sql)->execute();
    }
}
