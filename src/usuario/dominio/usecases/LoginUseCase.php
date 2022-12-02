<?php

class IniciarSesionUseCase
{

    private $iniciarSesionGateway;
    private $tokenGateway;
    public function __construct($loginGateway, $tokenGateway)
    {
        $this->iniciarSesionGateway = $loginGateway;
        $this->tokenGateway = $tokenGateway;
    }

    public function iniciarSesion($contrasena, $correo)
    {

        if (
            !Validador::validarNombre($contrasena)
            || !Validador::validarCorreo($correo)
        ) {
            return null;
        }

        $usuarioEncontrado = $this->iniciarSesionGateway->buscarPor($correo);

        if (is_null($usuarioEncontrado)) {
            return null;
        }

        $result = Validador::validarContrasenaHash($contrasena, $usuarioEncontrado["contrasena_usuario"]);

        if ($result == 1) {

            $datos = $this->tokenGateway->generarToken($usuarioEncontrado["id_usuario"], $usuarioEncontrado["correo_usuario"]);

            $resultx = $this->iniciarSesionGateway->actualizarToken($datos, $usuarioEncontrado["id_usuario"]);

            if ($resultx == 1) {
                $usuarioEncontrado = $this->iniciarSesionGateway->buscarPor($correo);

                return new DTOUsuario(
                    $usuarioEncontrado["id_usuario"],
                    $usuarioEncontrado["nombre_usuario"],
                    $contrasena,
                    $usuarioEncontrado["correo_usuario"],
                    $usuarioEncontrado["token"],
                    $usuarioEncontrado["token_exp"]
                );
            } else {
                return null;
            }

        }

        return null;
    }
}


?>