<?php

require_once('usuario/dominio/interfaces/IRegistrarGateway.php');
require_once('./connection.php');

class RegistrarGateway implements IRegistrarGateway {

	public function registrar($usuario) {
		
		$conn = Connection::connect();

		$contrasena = crypt($usuario->contrasena, "RSSFEEDCLEAN");
		$consulta = "INSERT INTO usuarios (nombre_usuario, contrasena_usuario, correo_usuario) VALUES ('".$usuario->nombre."','". $contrasena."', '". $usuario->correo."')";

		$result = mysqli_query($conn, $consulta);

		Connection::close($conn);
		return $result;

	}
}



?>