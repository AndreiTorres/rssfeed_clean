<?php

class EliminarURLUseCase
{
    private $operation;
    private $tokenGateway;
    public function __construct($gateway, $tokenGateway)
    {
        $this->operation = $gateway;
        $this->tokenGateway = $tokenGateway;
    }

    public function eliminarURL($url, $token, $correo)
    {
        $valido = $this->tokenGateway->validarToken($token, $correo);

        if (is_null($valido)) {
            return null;
        }

        if ($valido["message"] == "Ok") {

            $respuesta = $this->operation->eliminarURL($url, $valido["id_usuario"]);

            if (is_null($respuesta)) {
                return null;
            } else {
                $urls = $this->operation->obtenerURLs($valido["id_usuario"]);

                if (!is_null($urls)) {
                    return $urls;
                }
            }
        } else {
            return $valido;
        }
    }
}


?>