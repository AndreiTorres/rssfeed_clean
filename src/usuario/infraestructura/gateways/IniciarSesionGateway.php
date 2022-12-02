<?php

require_once('usuario/dominio/interfaces/IInicioSesionGateway.php');
require_once('./connection.php');

class IniciarSesionGateway implements IInicioSesionGateway {

	public function buscarPor($correo) {
		$conn = Connection::connect();

		$consulta = 'SELECT * FROM usuarios WHERE correo_usuario="'.$correo.'"';

		try {
			$result = mysqli_query($conn, $consulta);
		} catch (Exception $e) {
			return null;
		}

		if ($result->num_rows == 1) {
			return $result->fetch_assoc();
		  } else {
			return null;
		  }
	}

	public function actualizarToken($datos, $id) {

		$token = $datos["jwt"];
		$token_exp = $datos["exp"];
		
		$conn = Connection::connect();
		$consulta = "UPDATE usuarios SET token='".$token."',token_exp='".$token_exp."' WHERE id_usuario=".$id;
	
		try {
			$result = mysqli_query($conn, $consulta);
		} catch (Exception $e) {
			return null;
		}

		return $result;
	}
}



?>