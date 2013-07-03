<?php

namespace Squirrel\Database\Sql;

/**
 * Abstract database request with binding methods.
 *
 * @package Squirrel\Database\Sql
 * @author Valérian Galliat
 */
abstract class Request implements RequestInterface
{
    /**
     * @var string
     */
    protected $sql;

    /**
     * @var array
     */
    protected $identifiers;

    /**
     * @var array
     */
    protected $values;

    /**
     * @param string $sql
     */
    public function __construct($sql)
    {
        $this->sql = $sql;
    }

    /**
     * {@inheritdoc}
     */
    public function bindIdentifier($name, $value)
    {
        if (!isset($this->identifiers)) {
            $this->identifiers = array();
        }

        $this->identifiers[] = array($name, $value);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function bindValue($name, $value)
    {
        if (!isset($this->values)) {
            $this->values = array();
        }

        $this->values[] = array($name, $value);
        return $this;
    }

    /**
     * Compiles current request with binded values.
     *
     * @return string
     */
    protected function compile()
    {
        $sql = $this->sql;

        if (isset($this->identifiers)) {
            foreach ($this->identifiers as $identifier) {
                $replace = '`' . str_replace('`', '``', $identifier[1]) . '`';
                $sql = str_replace($identifier[0], $replace, $sql);
            }
        }

        if (isset($this->values)) {
            foreach ($this->values as $value) {
                $replace = '\'' . str_replace('\'', '\'\'', $value[1]) . '\'';
                $sql = str_replace($value[0], $replace, $sql);
            }
        }
        
        return $sql;
    }
}
