<?php

include 'RestaurantCheck.php';
use \PHPUnit\Framework\TestCase;

class RestaurantCheckTest extends TestCase {

  public function testWithTaxAndTip(){
    $meal = 100;
    $tax = 10;
    $tip = 20;
    $result = restaurant_check($meal, $tax, $tip);
    $this->assertEquals(130, $result);
  }

  public function testWithNoTip(){
    $meal = 100;
    $tax = 10;
    $tip = 0;
    $result = restaurant_check($meal, $tax, $tip);
    $this->assertEquals(110, $result);
  }

  public function testTipIsNotOnTax(){
    $meal = 100;
    $tax = 10;
    $tip = 10;
    $checkWithTax = restaurant_check($meal, $tax, $tip);
    $checkWithoutTax = restaurant_check($meal, 0, $tip);
    $expectedTax = $meal * ($tax / 100);
    $this->assertEquals($checkWithTax, $checkWithoutTax + $expectedTax);
  }

  public function testTipShouldIncludeTax(){
    $meal = 100;
    $tax = 10;
    $tip = 10;
    $result = restaurant_check($meal, $tax, $tip, true);
    $this->assertEquals(121, $result);
  }

  public function testTipShouldNotIncludeTax(){
    $meal = 100;
    $tax = 10;
    $tip = 10;
    $result = restaurant_check($meal, $tax, $tip, false);
    $this->assertEquals(120, $result);
  }

}

?>