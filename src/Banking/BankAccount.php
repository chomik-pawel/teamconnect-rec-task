<?php

namespace TeamConnect\Banking;

use TeamConnect\Shared\Money;

class BankAccount
{
    private int $id;
    private Money $balance;

    public function __construct(int $id, Money $balance)
    {
        $this->id = $id;
        $this->balance = $balance;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }

    public function credit(Payment $creditPayment): void
    {
        $this->balance = $this->balance->add($creditPayment->getAmount());;
    }
}
