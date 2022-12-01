<?php

Use PHPUnit\Framework\TestCase;
require("././src/manejadorurl/infraestructura/gateways/DB.php");

class ManejadorURLTest extends TestCase {

    private $manejadorURL;
    
    public function setUp():void{
        $this->manejadorURL = new ManejadorURL(new DB());
    }

    public function testManejadorURLInvalido() {
        $this->markTestSkipped('El metodo esta privado');
        $url = "";
        $this->assertFalse($this->manejadorURL->validarURL($url));
    }
    
    
    public function testManejadorURLValido() {
        $this->markTestSkipped("El metodo esta privado");
        $url = "https://rss.nytimes.com/services/xml/rss/nyt/Arts.xml";
        $this->assertTrue($this->manejadorURL->validarURL($url));
    }

    public function testManejadorURLLeerURLValido() {
        $url = "https://rss.nytimes.com/services/xml/rss/nyt/Arts.xml";
        $this->assertInstanceOf(SimpleXMLElement::class, $this->manejadorURL->leerURL($url));
    }

    public function testManejadorURLLeerURLInvalido() {
        $url = "";
        $this->assertNull($this->manejadorURL->leerURL($url));
    }
}

?>