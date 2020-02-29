<?php

namespace App\Services\Transaction;

use App\Enum\TransactionType;
use Illuminate\Support\Facades\DB;

class UpdateService
{
    protected $transaction;
    protected $customer;

    public function __construct($transaction, $customer)
    {
        $this->transaction = $transaction;
        $this->customer = $customer;
    }

    public function run()
    {
        DB::transaction(function () {
            if($this->transaction->transactionType === TransactionType::DEBIT) {
                $balance = $this->customer->customer_balance->clearedBalance - ($this->transaction->amount - $this->transaction->transaction_charge);
            }else {
                $balance = $this->customer->customer_balance->clearedBalance + ($this->transaction->amount - $this->transaction->transaction_charge);
            }
            $this->transaction->balanceAfter = $balance;
            $this->transaction->save();

            (new \App\Services\CustomerDetails\UpdateService($this->customer, $this->formulateData($this->transaction)));
        });
    }

    private function formulateData($transaction)
    {
        return [
            'availableBalance' => $transaction->balanceAfter,
            'clearedBalance' => $transaction->balanceAfter,
        ];
    }
}
