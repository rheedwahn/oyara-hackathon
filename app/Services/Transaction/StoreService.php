<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use App\Utilities\Utility;
use Carbon\Carbon;

class StoreService
{
    protected $customer;
    protected $data;

    public function __construct($customer, $data)
    {
        $this->customer = $customer;
        $this->data = $data;
    }

    public function run()
    {
        $transaction = new Transaction();
        $transaction->accountNumber = $this->customer->accountNumber;
        $transaction->amount = $this->data['amount'];
        $transaction->currency = $this->customer->currency;
        $transaction->channel = $this->data['channel'];
        $transaction->debitOrCredit = $this->data['debitOrCredit'];
        $transaction->narration = $this->data['narration'];
        $transaction->referenceId = Utility::generateReference();
        $transaction->transactionTime = Carbon::now();
        $transaction->transactionType = $this->data['transactionType'];
        $transaction->valueDate = Carbon::now();
        $transaction->transaction_charge = (new TransactionChargeService($this->data['channel'], $this->data['amount'], $this->customer))->run();
        $transaction->save();

        (new UpdateService($transaction, $this->customer))->run();

        return $transaction;
    }
}
