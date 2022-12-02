<?php

require("suscriptor/infraestructura/gateways/Operations.php");
require("suscriptor/dominio/usecases/eliminarUrl.php");

class EliminarController {

    public function eliminar($url, $token, $correo) {
        $operation = new Operations();
        $tokenGateway = new TokenGateway();
        $eliminarUseCase = new EliminarURLUseCase($operation, $tokenGateway);
        return $eliminarUseCase->eliminarURL($url, $token, $correo);
    }
}

?>