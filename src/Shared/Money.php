<?php

namespace TeamConnect\Shared;

class Money
{
    private int $amount;
    private CurrencyEnum $currency;

    private function __construct(int $amount, CurrencyEnum $currency)
    {
        if (!in_array($currency, [CurrencyEnum::Pln, CurrencyEnum::Eur])) {
            throw new \InvalidArgumentException('Invalid currency');
        }

        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function create(int $amount, $currency): self
    {
        return new self($amount, $currency);
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

    public function add(Money $addMoney): Money
    {
        if ($this->currency !== $addMoney->currency) {
            throw new DifferentCurrencyException('Currencies must be the same');
        }

        return Money::create($this->amount + $addMoney->getAmount(), $this->currency);
    }
}
