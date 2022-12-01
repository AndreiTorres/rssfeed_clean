<?php

class ObtenerNoticiasUseCase{
    
    private $obtenerNoticiasGateway;

    public function __construct($gateway) {
        $this->obtenerNoticiasGateway = $gateway;
    }

    public function obtenerNoticias($url){
        return $this->obtenerNoticiasGateway->obtenerNoticias($url);
    }
}








?>