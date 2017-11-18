<?php
declare(strict_types=1);

namespace Money\chapter06;

class Dollar extends Money
{
    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier): Dollar
    {
        return new Dollar( $this->amount * $multiplier);
    }
}
