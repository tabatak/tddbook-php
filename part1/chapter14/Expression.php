<?php
declare(strict_types=1);

namespace Money\chapter14;

interface Expression
{
  public function reduce(Bank $bank, string $to): Money;
}