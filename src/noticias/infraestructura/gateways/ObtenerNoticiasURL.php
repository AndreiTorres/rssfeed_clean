<?php

require_once("../../../noticias/dominio/interfaces/IObtenerNoticiasGateway.php");
require_once("../../../noticias/dominio/dtos/noticia.php");

class ObtenerNoticiasURL implements IObtenerNoticiasGateway {
    
    public function obtenerNoticias($url) {
        $feeds = $this->leerURL($url);
        
        if(is_null($feeds)){
            return;
        }

        $noticias = array();

        if (!empty($feeds)) {

            $site = $feeds->channel->title;

            foreach ($feeds->channel->item as $item) {
                
                if (count($noticias) == 10) break;
                
                $titulo = $item->title;
                $enlace = $item->link;
                $descripcion = $item->description;
                $fechaPublicacion = $item->pubDate . "\n";
                $fechaPublicacion = date('D, d M Y',strtotime($fechaPublicacion));
                $categoria = $item->category;
                $descripcion = $item->description;
                $pattern = "/<img[^>]+\>/i";
                preg_match($pattern, $descripcion, $match);

                if (empty($match)) {
                    $imagensrc = "https://unsplash.it/100/100?image=503";
                } else {
                    $descripcion = str_replace($match[0], "", $descripcion);
                    $pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';
                    preg_match($pattern, $match[0], $text);
                    $imagensrc = $text[1];
                    $imagensrc = urldecode($imagensrc);
                }

                if(empty($categoria)){
                    $categoria = "Otros";
                }

                $categoria = trim($categoria);
                
                $noticia = new DTONoticia(
                    $titulo,
                    $enlace,
                    $descripcion,
                    $fechaPublicacion,
                    $categoria,
                    $imagensrc
                );

                array_push($noticias, $noticia);
            }
        }

        echo "Se devuelven: " . count($noticias) . " noticias\n";
        return $noticias;
    }

    private function leerURL($url) {
        if ($this->validarURL($url)) {
            $feeds = simplexml_load_file($url);
            return $feeds;
        }

        return null;
    }

    private function validarURL($url) {
        if (@simplexml_load_file($url)) {
            return true;
        } else {
            return false;
        }
    }
}

?>