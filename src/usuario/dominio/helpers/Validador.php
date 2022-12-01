<?php

class Validador {
    static function validarNombre($nombre) {
        
        if (is_null($nombre) || empty($nombre)) {
            return false;
        }

        return strlen($nombre) > 2 && strlen($nombre) < 16;

    }

    static function validarContrasena($contrasena) {
        
        if (is_null($contrasena) || empty($contrasena)) {
            return false;
        }

        return strlen($contrasena) > 2 && strlen($contrasena) < 16;
    }

    static function validarCorreo($correo) {
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        return preg_match($pattern, $correo);
    }
}


?>