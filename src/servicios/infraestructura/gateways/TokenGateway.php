<?php

require_once('../vendor/autoload.php');
use Firebase\JWT\JWT;

require_once('servicios/dominio/interfaces/ITokenGateway.php');
require_once('./connection.php');

class TokenGateway implements ITokenGateway
{

    public function generarToken($id_usuario, $correo)
    {
        $time = time();

        $token = array(
            "iat" => $time,
            "exp" => $time + (60 * 60 * 24),
            "data" => [
                "id" => $id_usuario,
                "correo" => $correo
            ]
        );

        $jwt = JWT::encode($token, "RSSFEEDCLEAN", "HS256");

        return array(
            "jwt" => $jwt,
            "exp" => $token["exp"]
        );
    }

    public function validarToken($token, $correo)
    {
        $conn = Connection::connect();

        $consulta = 'SELECT * FROM usuarios WHERE correo_usuario="' . $correo . '"' . 'AND token="' . $token . '"';

        try {
            $result = mysqli_query($conn, $consulta);
        } catch (Exception $e) {
            return null;
        }

        if ($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();

            $time = time();

            if ($time < $usuario["token_exp"]) {
                return array(
                    "message" => "Ok",
                    "id_usuario" => $usuario["id_usuario"]
                );
            } else {
                return "Expirado";
            }

        } else {
            return null;
        }
    }
}


?>