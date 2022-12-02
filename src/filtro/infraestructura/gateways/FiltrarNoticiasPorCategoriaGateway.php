<?php

require_once('filtro/dominio/interfaces/IFiltrarNoticiasGateway.php');

class FiltrarNoticiasPorCategoriaGateway implements IFiltrarNoticiasGateway {
    public function filtrarNoticias($campo, $id_usuario) {
        $conn = Connection::connect();

		$consulta = 'SELECT * FROM urls INNER JOIN noticias ON urls.id_url = noticias.id_url WHERE id_usuario ='. $id_usuario .' AND noticia_categoria = "'.$campo.'"' ;

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