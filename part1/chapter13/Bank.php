<?php
declare(strict_types=1);

namespace Money\chapter13;

class Bank
{
  public function reduce(Expression $source, string $to): Money
  {
    return $source->reduce($to);
  }
}