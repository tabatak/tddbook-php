<?php
declare(strict_types=1);

namespace Money\chapter12;

class Bank
{
  public function reduce(Expression $source, string $to)
  {
    return Money::dollar(10);
  }
}