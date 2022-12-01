<?php

require_once('usuario/dominio/interfaces/IRegistrarGateway.php');

class RegistrarGateway implements IRegistrarGateway {

	public function registrar($usuario) {
        // Aqui se implementa en la bd

		echo "Registrando a: { " . $usuario->nombre . " " . $usuario->contrasena . " " . $usuario->correo . " }\n";

		// Aqui se devuelve true o false dependiendo el estado de la bd
	}
}



?>