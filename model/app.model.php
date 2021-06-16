<?php

namespace luna\model;

class app
{

    private $atributos;

    public function __construct()
    {
        $this->atributos = new \stdClass();
        date_default_timezone_set(data::$_TIMEZONE_);
        setlocale(LC_TIME, "es_ES");
    }

    public final function newData(\stdClass $data)
    {
        $this->atributos = $data;
        $this->atributos->existe = false;
    }

    public final function getData($nombre_atributo)
    {
        return isset($this->atributos->$nombre_atributo) ? $this->atributos->$nombre_atributo : null;
    }

}
