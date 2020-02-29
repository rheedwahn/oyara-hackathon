<?php

namespace App\Services\Transaction;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class ListService
{
    protected $start_date;
    protected $end_date;
    protected $account_number;
    protected $channel;
    protected $reference;

    public function __construct($start_date = null, $end_date = null, $account_number = null, $channel = null, $reference = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->account_number = $account_number;
        $this->channel = $channel;
        $this->reference = $reference;
    }

    public function run()
    {
        return DB::table('transactions')
                    ->when($this->start_date && $this->end_date, function ($query) {
                        return $query->whereBetween(DB::raw('DATE(created_at)'), array($this->start_date, $this->end_date));
                    })
                    ->when($this->account_number, function ($query) {
                        return $query->where('accountNumber', $this->account_number);
                    })
                    ->when($this->channel, function ($query) {
                        return $query->where('channel', $this->channel);
                    })
                    ->when($this->reference, function ($query) {
                        return $query->where('referenceId', $this->reference);
                    })
                    ->get();
    }
}
