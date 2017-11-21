<?php
declare(strict_types=1);

namespace Money\chapter15;

class Sum implements Expression
{
  public $augend;
  public $addend;

  public function __construct(Expression $augend, Expression $addend)
  {
    $this->augend = $augend;
    $this->addend = $addend;
  }

  public function plus(Expression $addend): Expression
  {
    return null;
  }

  public function reduce(Bank $bank, string $to): Money
  {
    $amount = $this->augend->reduce($bank, $to)->amount() 
      + $this->addend->reduce($bank, $to)->amount();
    return new Money($amount, $to);
  }
}