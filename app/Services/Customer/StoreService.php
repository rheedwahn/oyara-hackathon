<?php

namespace App\Services\Customer;

use App\Enum\CustomerStatus;
use App\Models\Customer;
use App\Models\CustomerBalance;
use App\Utilities\Utility;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StoreService
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function run()
    {
        DB::transaction(function () use (&$customer) {
            //Store Customer information
            $customer = new Customer();
            $customer->accountNumber = Utility::generateAccountNumber();
            $customer->accountName = $this->data['accountName'];
            $customer->currency = $this->data['currency'];
            $customer->accountOpeningDate = Carbon::now();
            $customer->lastTransactionDate = Carbon::now();
            $customer->accountType = $this->data['accountType'];
            $customer->bvn = $this->data['bvn'];
            $customer->fullname = $this->data['fullname'];
            $customer->phoneNumber = isset($this->data['phoneNumber']) ? $this->data['phoneNumber'] : '';
            $customer->email = isset($this->data['email']) ? $this->data['email'] : '';
            $customer->status = CustomerStatus::ACTIVE;
            $customer->save();

            //Store Customer balance information
            $customer_balance = new CustomerBalance();
            $customer_balance->accountNumber = $customer->accountNumber;
            $customer_balance->currency = $customer->currency;
            $customer_balance->availableBalance = 0;
            $customer_balance->clearedBalance = 0;
            $customer_balance->unclearBalance = 0;
            $customer_balance->holdBalance = 0;
            $customer_balance->minimumBalance = 0;
            $customer_balance->save();
        });

        return $customer;
    }
}
