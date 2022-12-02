<?php

require_once('usuario/infraestructura/gateways/IniciarSesionGateway.php');
require_once('usuario/dominio/usecases/LoginUseCase.php');
require_once('servicios/infraestructura/gateways/TokenGateway.php');

class LoginController {

    public function iniciarSesion($contrasena, $correo) {
        $iniciarSesionUseCase = new IniciarSesionUseCase(new IniciarSesionGateway(), new TokenGateway());

        return $iniciarSesionUseCase->iniciarSesion($contrasena, $correo);
    }

}

?>