<?php

class IniciarSesionUseCase {
    
    private $iniciarSesionGateway;

    public function __construct($gateway) {
        $this->iniciarSesionGateway = $gateway;
    }
    
    public function iniciarSesion($contrasena, $correo) {
        
        if (!Validador::validarNombre($contrasena)
            || !Validador::validarCorreo($correo)) {
            return null; 
        }
        
        $usuarioEncontrado = $this->iniciarSesionGateway->buscarPor($correo);
        
        if (is_null($usuarioEncontrado)) {
            return null;
        }

        $result = Validador::validarContrasenaHash($contrasena, $usuarioEncontrado["contrasena_usuario"]);
        
        if ($result == 1) {
            return new DTOUsuario(
                $usuarioEncontrado["nombre_usuario"],
                $contrasena,
                $usuarioEncontrado["correo_usuario"],
                $usuarioEncontrado["token"],
                $usuarioEncontrado["token_exp"]
            );
        }

        return null;
    }
}


?>