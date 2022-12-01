<?php

require("../gateways/Operations.php");
require("../../dominio/usecases/eliminarUrl.php");

class EliminarController {

    public function eliminar($url) {
        $operation = new Operations();
        $eliminarUseCase = new EliminarURLUseCase($operation);
        $eliminarUseCase->eliminarURL($url);
    }
}

$controller = new EliminarController();
$controller->eliminar("X");
?>