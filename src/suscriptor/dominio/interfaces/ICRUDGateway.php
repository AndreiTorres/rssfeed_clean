<?php

interface ICRUDGateway {
    public function agregarURL($url, $id_usuario);
    public function agregarNoticias($id_url, $noticias);
    public function eliminarURL($url, $id_usuario);
}

?>