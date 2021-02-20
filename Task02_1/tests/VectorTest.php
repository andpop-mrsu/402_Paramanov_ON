<?php

namespace Tests\VectorTest;

use App\Vector;
use PHPUnit\Framework\TestCase;

class VectorTest extends TestCase
{
    public function testAddition()
    {
        $v1 = new Vector(2, 6, 1);
    
        $v2 = new Vector(1, 5, -4);

        $this->assertSame("(3;11;-3)", $v1->add($v2)->__toString());
    }

    public function testSubtraction()
    {
        $v1 = new Vector(2, 6, 1);
    
        $v2 = new Vector(1, 5, -4);

        $this->assertSame("(1;1;5)", $v1->sub($v2)->__toString());
    }

    public function testNumberProduct()
    {
        $v1 = new Vector(2, 6, 1);

        $this->assertSame("(4;12;2)", $v1->product(2)->__toString());
    }

    public function testScalarProduct()
    {
        $v1 = new Vector(2, 6, 1);
    
        $v2 = new Vector(1, 5, -4);

        $this->assertEquals(28, $v1->scalarProduct($v2));
    }

    public function testVectorProduct()
    {
        $v1 = new Vector(2, 6, 1);
    
        $v2 = new Vector(1, 5, -4);

        $this->assertSame("(29;-9;-4)", $v1->vectorProduct($v2)->__toString());
    }
}
