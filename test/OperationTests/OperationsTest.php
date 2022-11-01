<?php

use PHPUnit\Framework\TestCase; 

class OperationsTest extends TestCase {

    private $op;
    
    public function setUp():void{
        $this->op = new Operations();
    }

    public function testSumWithTwoValues() {
        $this->assertEquals(7, $this->op->sum(2, 5));
    }
    
}

?>