<?php

namespace TeamConnect\Banking;

use TeamConnect\Shared\Money;

class BankAccount
{
    private const float TRANSACTIONAL_FEE_PERCENTAGE = 0.05;

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

    public function debit(Money $debitMoney): Payment
    {
        $transactionalFee = $debitMoney->getAmount() * (1 + self::TRANSACTIONAL_FEE_PERCENTAGE);

        $debitAmount = Money::create($transactionalFee, $debitMoney->getCurrency());
        $this->balance = $this->balance->subtract($debitAmount);

        return new Payment(random_int(1, 50), $debitAmount);
    }
}
