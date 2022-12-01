<?php

interface ICRUDGateway {
    public function agregarURL($url, $noticias);

    public function eliminarURL($url);
}

?>