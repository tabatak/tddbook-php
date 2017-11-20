<?php
declare(strict_types=1);

namespace Money\chapter13;

interface Expression
{
  public function reduce(string $to): Money;
}