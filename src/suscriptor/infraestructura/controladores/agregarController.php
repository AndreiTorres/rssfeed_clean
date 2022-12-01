<?php

require_once("../gateways/Operations.php");
require_once("../../dominio/usecases/agregarUrl.php");
require_once("../../../noticias/dominio/usecases/obtenerNoticias.php");
require_once("../../../noticias/infraestructura/gateways/ObtenerNoticiasURL.php");

class AgregarController {

    public function agregar($url) {
        $operation = new Operations();
        $obtenerNoticiasURLGateway = new ObtenerNoticiasURL();

        $obtenerNoticiasUseCase = new ObtenerNoticiasUseCase($obtenerNoticiasURLGateway);
        $noticias = $obtenerNoticiasUseCase->obtenerNoticias($url);

        $agregarUseCase = new AgregarURLUseCase($operation);
        $agregarUseCase->agregarURL($url, $noticias);
    }
}


$rssvalido = "https://rss.nytimes.com/services/xml/rss/nyt/Arts.xml";
$rssinvalido = "xD jajaja Andrei es puto";

$controller = new AgregarController();
$controller->agregar($rssvalido);
?>