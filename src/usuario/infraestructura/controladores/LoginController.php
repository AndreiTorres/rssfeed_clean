<?php

require_once('usuario/infraestructura/gateways/IniciarSesionGateway.php');
require_once('usuario/dominio/usecases/LoginUseCase.php');

class LoginController {

    public function iniciarSesion($contrasena, $correo) {
        $iniciarSesionGateway = new IniciarSesionGateway();

        $iniciarSesionUseCase = new IniciarSesionUseCase($iniciarSesionGateway);

        return $iniciarSesionUseCase->iniciarSesion($contrasena, $correo);
    }

}

?>