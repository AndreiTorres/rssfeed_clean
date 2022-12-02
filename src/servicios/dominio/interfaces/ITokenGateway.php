<?php

interface ITokenGateway {

    public function generarToken($id_usuario, $correo);

    public function validarToken($token, $correo); 

}

?>