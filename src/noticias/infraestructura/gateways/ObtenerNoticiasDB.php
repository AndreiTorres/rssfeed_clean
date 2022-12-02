<?php

require('noticias/dominio/interfaces/IObtenerNoticiasGateway.php');

class ObtenerNoticiasDB implements IObtenerNoticiasGateway {
    public function obtenerNoticias($url) {
        // TODO: Implementar
        
        echo "Obteniendo noticias de la db...";
    }
}

?>