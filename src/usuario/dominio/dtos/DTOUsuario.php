<?php

class DTOUsuario
{

    public $id;
    public string $nombre;
    public string $contrasena;
    public string $correo;

    public $token;

    public $token_exp;


    public function __construct($id, $nombre, $contrasena, $correo, $token, $token_exp)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->contrasena = $contrasena;
        $this->correo = $correo;
        $this->token = $token;
        $this->token_exp = $token_exp;
    }
}

?>