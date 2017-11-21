<?php
declare(strict_types=1);

namespace Money\chapter15;

interface Expression
{
  public function plus(Expression $addend): Expression;
  public function reduce(Bank $bank, string $to): Money;
}