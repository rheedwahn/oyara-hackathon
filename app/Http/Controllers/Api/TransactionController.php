<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\ListRequest;
use App\Http\Requests\Transaction\StoreRequest;
use App\Http\Resources\Transaction\TransactionResource;
use App\Services\Transaction\ListService;
use App\Services\Transaction\StoreService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('currency')->only('store');
        $this->middleware('check_status')->only('store');
        $this->middleware('customer_balance')->only('store');
    }

    public function store(StoreRequest $request, $customer_id)
    {
        $data = $request->all();
        $customer = $this->getCustomerById($customer_id);
        $transaction = (new StoreService($customer, $data))->run();
        return new TransactionResource($transaction);
    }

    public function list(ListRequest $request)
    {
        $transactions = (new ListService($request->start_date, $request->end_date,
                            $request->account_number, $request->channel, $request->reference))->run();
        return TransactionResource::collection($transactions);
    }
}
