<?php
declare(strict_types=1);

namespace Money\chapter03;

use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMultiplication()
    {
        $five = new Dollar(5);

        $product = $five->times(2);
        $this->assertEquals(10, $product->amount);

        $product = $five->times(3);
        $this->assertEquals(15, $product->amount);
    }

    public function testEquality()
    {
        $this->assertTrue((new Dollar(5))->equals(new Dollar(5)));
        $this->assertFalse((new Dollar(5))->equals(new Dollar(6)));
    }
}
