<?php

require_once('usuario/dominio/interfaces/IInicioSesionGateway.php');
require_once('./connection.php');

class IniciarSesionGateway implements IInicioSesionGateway {

	public function buscarPor($correo) {
		$conn = Connection::connect();

		$consulta = 'SELECT * FROM usuarios WHERE correo_usuario="'.$correo.'"';

		$result = mysqli_query($conn, $consulta);

		if ($result->num_rows == 1) {
			return $result->fetch_assoc();
		  } else {
			return null;
		  }
	}
}



?>