<?php

class DTONoticia {

    public string $titulo;
    public string $enlace;
    public string $descripcion;
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