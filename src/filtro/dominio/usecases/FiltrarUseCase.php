<?php

class FiltrarUseCase{
    
    private $filtrarNoticiasGateway;

    public function __construct($gateway) {
        $this->filtrarNoticiasGateway = $gateway;
    }

    public function filtrar($campo, $id_usuario){
        return $this->filtrarNoticiasGateway->filtrarNoticias($campo, $id_usuario);
    }
}








?>