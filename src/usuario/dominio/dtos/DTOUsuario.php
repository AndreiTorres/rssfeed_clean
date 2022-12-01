<?php

class DTOUsuario
{

    public string $nombre;
    public string $contrasena;
    public string $correo;


    public function __construct($nombre, $contrasena, $correo)
    {
        $this->nombre = $nombre;
        $this->contrasena = $contrasena;
        $this->correo = $correo;
    }
}

?>