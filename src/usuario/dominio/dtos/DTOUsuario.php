<?php

class DTOUsuario
{

    public string $nombre;
    public string $contrasena;
    public string $correo;

    public $token;

    public $token_exp;


    public function __construct($nombre, $contrasena, $correo, $token, $token_exp)
    {
        $this->nombre = $nombre;
        $this->contrasena = $contrasena;
        $this->correo = $correo;
        $this->token = $token;
        $this->token_exp = $token_exp;
    }
}

?>