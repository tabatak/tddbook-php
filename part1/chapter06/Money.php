<?php
declare(strict_types=1);

namespace Money\chapter06;

class Money
{
    protected $amount;

    public function equals(Money $money): bool
    {
        return $this->amount === $money->amount;
    }
}
