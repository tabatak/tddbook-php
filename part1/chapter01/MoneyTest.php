<?php

namespace Money\chapter01;

use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMultiplication()
    {
        $five = new Dollar(5);
        $five->times(2);
    
        $this->assertEquals(10, $five->amount);
    }
}
