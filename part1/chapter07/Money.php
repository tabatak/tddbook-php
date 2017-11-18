<?php
declare(strict_types=1);

namespace Money\chapter07;

class Money
{
    protected $amount;

    public function equals(Money $money): bool
    {
        return $this->amount === $money->amount
                && get_class($this) === get_class($money);
    }
}
