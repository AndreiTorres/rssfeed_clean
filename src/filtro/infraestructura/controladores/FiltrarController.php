<?php

require_once('filtro/infraestructura/gateways/FiltrarNoticiasPorCategoriaGateway.php');
require_once('filtro/dominio/usecases/FiltrarUseCase.php');

class FiltrarController {

    public function filtrar($campo, $id_usuario) {
        $filtrarUseCase = new FiltrarUseCase(new FiltrarNoticiasPorCategoriaGateway());

        return $filtrarUseCase->filtrar($campo, $id_usuario);
    }

}

?>