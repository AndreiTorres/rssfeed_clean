<?php

require_once('usuario/dominio/dtos/DTOUsuario.php');
require_once('usuario/dominio/helpers/Validador.php');

class RegistrarseUseCase {
    

    private $registrarGateway;
    
    public function __construct($gateway) {
        $this->registrarGateway = $gateway;
    }

    public function crearNuevoUsuario($nombre, $contrasena, $correo) {
        
        // Se validan los datos del usuario
        if (!Validador::validarNombre($nombre) 
            || !Validador::validarNombre($contrasena)
            || !Validador::validarCorreo($correo)) {

            return null; 
        }
        
        $usuario = new DTOUsuario(
            $nombre,
            $contrasena,
            $correo
        );

        $this->registrarGateway->registrar($usuario);

        // Si el usuario se registro se devuelve al usuario
        // Si el usuario no se registro se devuelve null
        return $usuario;
    }

}

?>