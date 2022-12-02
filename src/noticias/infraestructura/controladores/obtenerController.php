<?php

require_once('noticias/infraestructura/gateways/ObtenerNoticiasDB.php');
require_once("noticias/infraestructura/gateways/ObtenerNoticiasURL.php");
require_once("noticias/dominio/usecases/obtenerNoticias.php");

class ObtenerController {

    public function obtenerNoticias($url, $flag, $id_usuario) {

        $gateway = "";

        if ($flag) {
            $gateway = new ObtenerNoticiasDB();
        } else {
            $gateway = new ObtenerNoticiasURL();
        }

        $obtenerNoticiasUseCase = new ObtenerNoticiasUseCase($gateway);
        return$obtenerNoticiasUseCase->obtenerNoticias($url, $id_usuario);
    }
}
?>