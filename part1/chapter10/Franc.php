<?php
declare(strict_types=1);

namespace Money\chapter10;

class Franc extends Money
{
    public function __construct(int $amount, string $currency)
    {
        parent::__construct($amount, $currency);
    }
}
