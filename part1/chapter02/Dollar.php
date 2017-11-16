<?php
declare(strict_types=1);

namespace Money\chapter02;

class Dollar
{
    public $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier): Dollar
    {
        return new Dollar( $this->amount * $multiplier);
    }
}
