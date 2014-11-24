<?php

/**
 *
 * @author Luís Augusto Weber Mercado
 */
abstract class InnerModel
{
    private $Inner;        

    abstract public function validaDados();

    public function __construct()
    {
        $this->Inner = Inner::instance();

    }

    public function __set($name, $value)
    {
        $this->$name = $value;

    }

    public function __get($name)
    {
        return $this->$name;

    }

}

?>