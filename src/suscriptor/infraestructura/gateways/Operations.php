<?php

require('suscriptor/dominio/interfaces/ICRUDGateway.php');

class Operations implements ICRUDGateway
{

    public function agregarURL($url, $id_usuario)
    {

        $conn = Connection::connect();
        $feeds = $this->leerURL($url);

        if (is_null($feeds)) {
            return null;
        }

        if (!empty($feeds)) {
            $sitio = $feeds->channel->title;
            $consulta = "INSERT INTO urls (sitio_url, enlace, id_usuario) VALUES ('" . $sitio . "','" . $url . "', '" . $id_usuario . "')";

            try {
                $result = mysqli_query($conn, $consulta);
            } catch (Exception $e) {
                return null;
            }

            if ($result == 1) {

                $consulta = 'SELECT id_url FROM urls WHERE enlace="' . $url . '"' . 'AND id_usuario="' . $id_usuario . '"';

                try {
                    $result = mysqli_query($conn, $consulta);
                    $url = $result->fetch_assoc();
                    mysqli_close($conn);
                    return $url["id_url"];
                } catch (Exception $e) {
                    return null;
                }
            }

        }
    }

    public function agregarNoticias($id_url, $noticias)
    {
        $conn = Connection::connect();

        foreach ($noticias as $noticia) {

            $titulo = mysqli_real_escape_string($conn, $noticia->titulo);
            $enlace = mysqli_real_escape_string($conn, $noticia->enlace);
            $descripcion = mysqli_real_escape_string($conn, $noticia->descripcion);
            $fechapub = mysqli_real_escape_string($conn, $noticia->fechaPublicacion);
            $categoria = mysqli_real_escape_string($conn, $noticia->categoria);
            $imagen = mysqli_real_escape_string($conn, $noticia->imagen);

            $consulta = "INSERT INTO noticias (noticia_titulo, noticia_enlace, noticia_descripcion, noticia_fechapub, noticia_categoria, noticia_imagen, id_url) VALUES ('" . $titulo . "', '" . $enlace . "', '" . $descripcion . "','" . $fechapub . "','" . $categoria . "', '" . $imagen . "', '" . $id_url . "')";

            try {
                $result = mysqli_query($conn, $consulta);
            } catch (Exception $e) {
                return null;
            }
        }

        mysqli_close($conn);
        return "Ok";
    }

    public function obtenerURLs($id_usuario)
    {
        $conn = Connection::connect();
        $consulta = 'SELECT * FROM urls WHERE id_usuario="' . $id_usuario . '"';

        $urls = array();
        try {
            $result = mysqli_query($conn, $consulta);
            while ($row = $result->fetch_assoc()) {
                array_push($urls, $row);                 
            }
            
            mysqli_close($conn);
            return $urls;
        } catch (Exception $e) {
            return null;
        }
    }

    private function leerURL($url)
    {
        if ($this->validarURL($url)) {
            $feeds = simplexml_load_file($url);
            return $feeds;
        }

        return null;
    }

    private function validarURL($url)
    {
        if (@simplexml_load_file($url)) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarURL($url, $id_usuario)
    {

        $conn = Connection::connect();
        $consulta = 'DELETE FROM urls WHERE enlace="' . $url . '"' . 'AND id_usuario="' . $id_usuario . '"';

        $urls = array();
        try {
            $result = mysqli_query($conn, $consulta);
            mysqli_close($conn);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
}

?>