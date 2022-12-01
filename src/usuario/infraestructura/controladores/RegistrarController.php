<?php

require_once('usuario/infraestructura/gateways/RegistrarGateway.php');
require_once('usuario/dominio/usecases/RegistrarUseCase.php');

class RegistrarController {

    public function registrar($nombre, $contrasena, $correo) {
        $registrarGateway = new RegistrarGateway();

        $registrarUseCase = new RegistrarseUseCase($registrarGateway);

        return $registrarUseCase->crearNuevoUsuario($nombre, $contrasena, $correo);
    }

}

?>