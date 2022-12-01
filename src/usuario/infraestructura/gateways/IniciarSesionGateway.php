<?php

require_once('usuario/dominio/interfaces/IInicioSesionGateway.php');

class IniciarSesionGateway implements IInicioSesionGateway {

	public function buscarPor($contrasena, $correo) {
        // Aqui se implementa en la bd

		echo "Buscando a: { " . $contrasena . " " . $correo . " }\n";

		// Aqui se devuelve true o false dependiendo el estado de la bd
	}
}



?>