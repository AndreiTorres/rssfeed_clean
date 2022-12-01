<?php

class EliminarURLUseCase {
    private $operation;

    public function __construct($gateway) {
        $this->operation = $gateway;
    }

    public function eliminarURL($url) {
        $this->operation->eliminarURL($url);
    }
}

?>