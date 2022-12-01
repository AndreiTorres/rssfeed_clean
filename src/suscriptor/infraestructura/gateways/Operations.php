<?php

require('../../dominio/interfaces/ICRUDGateway.php');

class Operations implements ICRUDGateway {

    public function agregarURL($url, $noticias) {
        echo "Agregando: " . count($noticias) . " noticias.";
        // TODO: Query para guardar URL
        /*
        $sql = "INSERT INTO urls (nombre, enlace) VALUES ('".$url->site."','".$url->enlace."')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        echo "Funcion agregar";*/

        // Aqui se guardan las noticias de esta url
    }

    public function eliminarURL($url) {
        // TODO: Query para eliminar URL
        echo "Funcion eliminar";
    }
}

?>