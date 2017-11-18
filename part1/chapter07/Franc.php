<?php
declare(strict_types=1);

namespace Money\chapter07;

class Franc extends Money
{
    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier): Franc
    {
        return new Franc( $this->amount * $multiplier);
    }
}
