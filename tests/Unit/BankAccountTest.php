<?php

namespace Tests\Unit;

use Codeception\Test\Unit;
use TeamConnect\Banking\Payment;
use TeamConnect\Shared\DifferentCurrencyException;
use TeamConnect\Banking\InsufficientFundsException;
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

    public function testDebitWithSameCurrency(): void
    {
        // Arrange
        $sut = new BankAccount(1, Money::create(10000, CurrencyEnum::Pln));

        // Act
        $debitAmountValue = 5000;
        $debitAmount = Money::create($debitAmountValue, CurrencyEnum::Pln);
        $debitPayment = $sut->debit($debitAmount);

        // Assert
        $currentBalance = $sut->getBalance();

        $expectedBalance = Money::create(4750, CurrencyEnum::Pln);
        $expectedPaymentAmount = Money::create(5250, CurrencyEnum::Pln);
        $this->assertEquals($expectedBalance, $currentBalance);
        $this->assertEquals($expectedPaymentAmount, $debitPayment->getAmount());;
    }

    public function testDebitWithDifferentCurrency(): void
    {
        // Arrange
        $sut = new BankAccount(1, Money::create(10000, CurrencyEnum::Eur));

        // Assert
        $this->expectException(DifferentCurrencyException::class);

        // Act
        $debitMoney = Money::create(5000, CurrencyEnum::Pln);
        $sut->debit($debitMoney);
    }

    public function testExpectInsufficientFundsException(): void
    {
        // Arrange
        $sut = new BankAccount(1, Money::create(10000, CurrencyEnum::Pln));

        // Assert
        $this->expectException(InsufficientFundsException::class);

        // Act
        $debitAmountValue = 10000;
        $debitAmount = Money::create($debitAmountValue, CurrencyEnum::Pln);
        $sut->debit($debitAmount);
    }
}
