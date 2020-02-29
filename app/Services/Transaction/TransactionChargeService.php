<?php

namespace App\Services\Transaction;

use App\Enum\TransactionChannel;
use App\Models\Transaction;

class TransactionChargeService
{
    const POS_MAX_VALUE = 1200;
    const POS_PERCENTAGE = 0.75;

    const ECHANNEL_MAX_VALUE_BELOW_5000 = 10;
    const ECHANNEL_MAX_VALUE_BELOW_50000 = 25;
    const ECHANNEL_MAX_VALUE_ABOVE_50000 = 50;

    const ECHANNEL_MAX_PERCENTAGE_BELOW_5000 = 5;
    const ECHANNEL_MAX_PERCENTAGE_BELOW_50000 = 4.5;
    const ECHANNEL_MAX_PERCENTAGE_ABOVE_50000 = 3;

    const ATM_CHARGE = 35;

    protected $channel;
    protected $amount;
    protected $customer;

    public function __construct($channel, $amount, $customer)
    {
        $this->channel = $channel;
        $this->amount = $amount;
        $this->customer = $customer;
    }

    public function run()
    {
        return $this->transactionChannel($this->channel, $this->amount, $this->customer);
    }

    protected function transactionChannel($channel, $amount, $customer)
    {
        switch ($channel) {
            case $channel === TransactionChannel::POS:
                return $this->calculateCharge(self::POS_MAX_VALUE,$amount,self::POS_PERCENTAGE);
                break;
            case $channel === TransactionChannel::ECHANNEL:
                return $this->eChannelCharge($amount);
                break;
            default :
                return $this->atmCharge($customer);
        }
    }

    protected function eChannelCharge($amount)
    {
        if($amount <= 5000) {
            return $this->calculateCharge(self::ECHANNEL_MAX_VALUE_BELOW_5000, $amount, self::ECHANNEL_MAX_PERCENTAGE_BELOW_5000);
        }elseif ($amount > 5000 && $amount <=50000) {
            return $this->calculateCharge(self::ECHANNEL_MAX_VALUE_BELOW_50000, $amount, self::ECHANNEL_MAX_PERCENTAGE_BELOW_50000);
        }else {
            return $this->calculateCharge(self::ECHANNEL_MAX_VALUE_ABOVE_50000, $amount, self::ECHANNEL_MAX_PERCENTAGE_ABOVE_50000);
        }
    }

    protected function atmCharge($customer)
    {
        $transactions = Transaction::where('accountNumber', $customer->accountNumber)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->get()->toArray();
        if(count($transactions) > 3) {
            return self::ATM_CHARGE;
        }
    }

    protected function calculateCharge($maximum_value, $amount, $percentage)
    {
        $calculated_amount = ($percentage / 100 ) * $amount;
        return $calculated_amount < $maximum_value ? $calculated_amount : $maximum_value;
    }
}
