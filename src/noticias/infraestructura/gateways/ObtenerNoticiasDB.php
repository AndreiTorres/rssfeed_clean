<?php

require('noticias/dominio/interfaces/IObtenerNoticiasGateway.php');

class ObtenerNoticiasDB implements IObtenerNoticiasGateway {
    public function obtenerNoticias($url, $id_usuario) {
        $conn = Connection::connect();

		$consulta = 'SELECT * FROM urls INNER JOIN noticias ON urls.id_url = noticias.id_url WHERE id_usuario ='. $id_usuario .' AND urls.enlace = "'.$url.'"';

		$noticias = array();
        try {
            $result = mysqli_query($conn, $consulta);
            while ($row = $result->fetch_assoc()) {
                array_push($noticias, $row);                 
            }
            
            mysqli_close($conn);
            return $noticias;
        } catch (Exception $e) {
            return null;
        }
    }
}

?>