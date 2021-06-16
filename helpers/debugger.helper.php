<?php

namespace luna\helpers;

class debugger
{

    static $objDebug = array();

    static function reportar($mensaje, $donde, $traza = null, $e = null)
    {
        $error = new \stdClass();
        $error->timestamp = (new \Datetime());
        $error->mensaje = $mensaje;
        $error->donde = $donde;
        $error->traza = $traza;
        $error->throwable = $e;

        self::$objDebug[] = $error;
    }

    static function reporte()
    {
        return self::$objDebug;
    }

    static function volcar($fullcrash = false)
    {
        $mensaje_final = null;
        if (\luna\model\data::$_DEBUG_) {
            $mensaje_final = ["status_id" => "0",
                "status" => "INTERNAL ERROR",
                "mensaje" => "Error interno.",
                "detalle" => self::$objDebug];
        } else {
            $mensaje_final = ["status_id" => "0",
                "status" => "INTERNAL ERROR",
                "mensaje" => "Error interno. Por favor contacte a un administrador"];
        }

        echo json_encode($mensaje_final);

        if ($fullcrash) {
            die();
        }
    }

}
