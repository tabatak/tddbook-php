<?php
declare(strict_types=1);

namespace Money\chapter05;

use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMultiplication()
    {
        $five = new Dollar(5);

        // extendsしてequalsメソッドを実装して、assertEquals(objA, objB)ってした方がいいんだろうな
        $this->assertTrue((new Dollar(10))->equals($five->times(2)));
        $this->assertTrue((new Dollar(15))->equals($five->times(3)));
    }

    public function testEquality()
    {
        $this->assertTrue((new Dollar(5))->equals(new Dollar(5)));
        $this->assertFalse((new Dollar(5))->equals(new Dollar(6)));
    }

    public function testFrancMultiplication()
    {
        $five = new Franc(5);

        $this->assertTrue((new Franc(10))->equals($five->times(2)));
        $this->assertTrue((new Franc(15))->equals($five->times(3)));
    }
}
