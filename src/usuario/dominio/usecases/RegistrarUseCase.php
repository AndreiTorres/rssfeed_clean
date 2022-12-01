<?php

require_once('usuario/dominio/dtos/DTOUsuario.php');
require_once('usuario/dominio/helpers/Validador.php');

class RegistrarseUseCase {
    

    private $registrarGateway;
    
    public function __construct($gateway) {
        $this->registrarGateway = $gateway;
    }

    public function crearNuevoUsuario($nombre, $contrasena, $correo) {
        
        if (!Validador::validarNombre($nombre) 
            || !Validador::validarNombre($contrasena)
            || !Validador::validarCorreo($correo)) {

            return null; 
        }
        
        $usuario = new DTOUsuario(
            $nombre,
            $contrasena,
            $correo,
            null,
            null
        );

        $result = $this->registrarGateway->registrar($usuario);

        if ($result == 0) {
            return null;
        }

        return $usuario;
    }

}

?>