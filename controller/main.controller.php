<?php

namespace luna\controller;

class main implements controlador
{

    public $obj;

    public function __construct()
    {
        $this->obj = new \luna\model\app();
    }

    public function run()
    {
        $app = new \luna\model\app();
        $cambios = [];
        $welcome_array = ["status_id" => "1", "status" => "ok", "message" => "Welcome to Luna"];
        echo json_encode($welcome_array);
    }

}
