<?php
declare(strict_types=1);

namespace Money\chapter15;

class Bank
{
  private $rate;

  public function reduce(Expression $source, string $to): Money
  {
    return $source->reduce($this, $to);
  }

  public function addRate(string $from, string $to, int $rate)
  {
    $this->rate[(new Pair($from, $to))->hashCode()] = $rate;
  }

  public function rate(string $from, string $to): int
  {
    if($from === $to)
    {
      return 1;
    }
    return $this->rate[(new Pair($from, $to))->hashCode()];
  }
}