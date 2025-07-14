<?php

namespace TeamConnect\Banking;

use TeamConnect\Shared\Money;

class Payment
{
    private int $id;
    private Money $amount;

    public function __construct(int $id, Money $amount)
    {
        $this->id = $id;
        $this->amount = $amount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }
}
