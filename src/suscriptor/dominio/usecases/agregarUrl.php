<?php

class AgregarURLUseCase {

    private $operation;
    
    public function __construct($CRUDGateway) {
        $this->operation = $CRUDGateway;
    }

    public function agregarURL($url, $noticias) {
        $this->operation->agregarURL($url, $noticias);
    }
}

?>