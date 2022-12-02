<?php

require_once("suscriptor/infraestructura/gateways/Operations.php");
require_once("suscriptor/dominio/usecases/agregarUrl.php");
require_once("noticias/dominio/usecases/obtenerNoticias.php");
require_once("noticias/infraestructura/gateways/ObtenerNoticiasURL.php");
require_once("servicios/infraestructura/gateways/TokenGateway.php");
class AgregarController {

    public function agregar($url, $token, $correo) {
        $operation = new Operations();
        $obtenerNoticiasURLGateway = new ObtenerNoticiasURL();

        $obtenerNoticiasUseCase = new ObtenerNoticiasUseCase($obtenerNoticiasURLGateway);
        $noticias = $obtenerNoticiasUseCase->obtenerNoticias($url, null);

        $tokenGateway = new TokenGateway();
        $agregarUseCase = new AgregarURLUseCase($operation, $tokenGateway);
        return $agregarUseCase->agregarURL($url, $noticias, $token, $correo);
    }
}

?>