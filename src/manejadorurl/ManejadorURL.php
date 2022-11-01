<?php

class ManejadorURL {

    private $feeds;
    
    public function __construct() {
        
    }

    public function validarURL(string $url) {
        if (@simplexml_load_file($url)) {
            return true;
        } else {
            return false;
        }
    }

    public function leerURL(string $url) {
        if ($this->validarURL($url)) {
            $feeds = simplexml_load_file($url);
            return $feeds;
        }

        return null;
    }

}

?>