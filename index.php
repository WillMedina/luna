<?php

use luna\{
    model,
    controller,
    helpers
};

namespace luna;

session_start();

//ini_set('display_errors', 0);
//ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);

require_once 'model/dependencias.php';

$archivo = '';
$nombre = '';
$funcion = '';

$get_controller = filter_input(INPUT_GET, 'controller', FILTER_SANITIZE_STRING);
$get_action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

//candado para verificar si sale por json o no
if (model\data::$_JSON) {
    header('Content-type:application/json;charset=utf-8');
}

if (!is_null($get_controller) and strlen($get_controller) > 0) {
    $archivo = 'controller/' . helpers\utils::input_sanitize($get_controller) . '.controller.php';
    $model = 'model/' . helpers\utils::input_sanitize($get_controller) . '.model.php';
    $nombre = __NAMESPACE__ . '\\controller\\' . helpers\utils::input_sanitize($get_controller);

    if (!is_null($get_action) and strlen($get_action) > 0) {
        $funcion = helpers\utils::input_sanitize($get_action);
    } else {
        $funcion = 'run';
    }
} else {
    $nombre = __NAMESPACE__ . '\\controller\\main';
    $funcion = 'run';
}

if (file_exists($archivo) and $archivo != 'controller/main.controller.php') {
    require $archivo;
    require $model;
}

try {
    if (method_exists($nombre, $funcion)) {
        $controller = new $nombre();
        $controller->$funcion();
    } else {
        helpers\debugger::reportar('No existe el m&eacute;todo ' . $function, 'index.php');
        helpers\debugger::volcar(true);
    }
} catch (\Throable $e) {
    //echo $e->getMessage();
    helpers\debugger::reportar('Error interno desconocido', 'index.php', $e->getTraceAsString(), $e);
    helpers\debugger::volcar(true);
}
