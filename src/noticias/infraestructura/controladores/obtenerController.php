<?php

require("../gateways/ObtenerNoticiasDB.php");
require("../gateways/ObtenerNoticiasURL.php");
require("../../dominio/usecases/obtenerNoticias.php");

class ObtenerController {

    //private $gateway

    // Algo es una bandera para saber si se necesitan las noticias de la bd o del url
    public function obtenerNoticias($url, $algo) {

        $gateway = "";

        // true si es de la bd
        if ($algo) {
            $gateway = new ObtenerNoticiasDB();
        } else {
            $gateway = new ObtenerNoticiasURL();
        }

        $obtenerNoticiasUseCase = new ObtenerNoticiasUseCase($gateway);
        $obtenerNoticiasUseCase->obtenerNoticias($url);
    }
}

$rssvalido = "https://rss.nytimes.com/services/xml/rss/nyt/Arts.xml";
$rssinvalido = "xD jajaja Andrei es puto";

$controller = new ObtenerController();
$controller->obtenerNoticias($rssvalido, false);
?>