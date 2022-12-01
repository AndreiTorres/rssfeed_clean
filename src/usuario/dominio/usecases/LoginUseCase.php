<?php

class IniciarSesionUseCase {
    
    private $iniciarSesionGateway;

    public function __construct($gateway) {
        $this->iniciarSesionGateway = $gateway;
    }
    
    public function iniciarSesion($contrasena, $correo) {
        // Validar los campos
        // contraseña que tenga 10 caracteres
        // correo coincida con un patrón
        // deberia usar un gateway de la bd
        // Se validan los datos del usuario
        if (!Validador::validarNombre($contrasena)
            || !Validador::validarCorreo($correo)) {
            return null; 
        }
        
        $this->iniciarSesionGateway->buscarPor($contrasena, $correo);
        
        //Se reciben datos del Gateway
        $usuario = new DTOUsuario(
            "Jhon Doe",
            $contrasena,
            $correo
        );
        // Si el usuario se registro se devuelve al usuario
        // Si el usuario no se registro se devuelve null
        return $usuario;
    }
}


?>