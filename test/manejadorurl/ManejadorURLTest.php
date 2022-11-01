<?php

Use PHPUnit\Framework\TestCase;

class ManejadorURLTest extends TestCase {

    private $manejadorURL;
    
    public function setUp():void{
        $this->manejadorURL = new ManejadorURL();
    }

    public function testManejadorURLInvalido() {
        $url = "";
        $this->assertFalse($this->manejadorURL->validarURL($url));
    }
    
    
    public function testManejadorURLValido() {
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