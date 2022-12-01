<?php

class DTONoticia {

    public $titulo;
    public $enlace;
    public $descripcion;
    public $fechaPublicacion;
    public $categoria;
    public $imagen;

    public function __construct($titulo, $enlace, $descripcion, $fechaPublicacion, $categoria, $imagen) {
        $this->titulo = $titulo;
        $this->enlace = $enlace;
        $this->descripcion = $descripcion;
        $this->fechaPublicacion = $fechaPublicacion;
        $this->categoria = $categoria;
        $this->imagen = $imagen;
    }
}

?>