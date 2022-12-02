<?php

class AgregarURLUseCase
{

    private $operationGateway;
    private $tokenGateway;

    public function __construct($CRUDGateway, $tokenGateway)
    {
        $this->operationGateway = $CRUDGateway;
        $this->tokenGateway = $tokenGateway;
    }

    public function agregarURL($url, $noticias, $token, $correo)
    {
        $valido = $this->tokenGateway->validarToken($token, $correo);

        if (is_null($valido)) {
            return null;
        }

        if ($valido["message"] == "Ok") {
            $id_url = $this->operationGateway->agregarURL($url, $valido["id_usuario"]);

            if (is_null($id_url)) {
                return "Error al agregar URL";
            }

            $respuesta = $this->operationGateway->agregarNoticias($id_url, $noticias);

            if ($respuesta == "Ok") {
                $urls = $this->operationGateway->obtenerURLs($valido["id_usuario"]);
                
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