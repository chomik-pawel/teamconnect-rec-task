<?php

namespace Tests\Unit;

use Codeception\Test\Unit;
use TeamConnect\Banking\Payment;
use TeamConnect\Shared\DifferentCurrencyException;
use TeamConnect\Banking\BankAccount;
use TeamConnect\Shared\CurrencyEnum;
use TeamConnect\Shared\Money;

class BankAccountTest extends Unit
{
    public function testCreditWithSameCurrency(): void
    {
        // Arrange
        $sut = new BankAccount(1, Money::create(0, CurrencyEnum::Pln));

        // Act
        $creditPayment = new Payment(1, Money::create(100, CurrencyEnum::Pln));
        $sut->credit($creditPayment);

        // Assert
        $currentBalance = $sut->getBalance();

        $expectedBalance = Money::create(100, CurrencyEnum::Pln);
        $this->assertEquals($expectedBalance, $currentBalance);
    }

    public function testCreditWithDifferentCurrency(): void
    {
        // Arrange
        $sut = new BankAccount(1, Money::create(0, CurrencyEnum::Eur));

        // Assert
        $this->expectException(DifferentCurrencyException::class);

        // Act
        $creditPayment = new Payment(2, Money::create(100, CurrencyEnum::Pln));
        $sut->credit($creditPayment);
    }
}
