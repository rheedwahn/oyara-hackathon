<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'accountNumber' => $this->accountNumber,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'channel' => $this->channel,
            'debitOrCredit' => $this->debitOrCredit,
            'narration' => $this->narration,
            'referenceId' => $this->referenceId,
            'transactionTime' => $this->transactionTime,
            'transactionType' => $this->transactionType,
            'valueDate' => date('Y-m-d', strtotime($this->valueDate)),
            'balanceAfter' => $this->balanceAfter,
            'charge' => $this->transaction_charge
        ];
    }
}
