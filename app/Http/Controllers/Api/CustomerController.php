<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetCustomerRequest;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Resources\Customer\CustomerBalanceResource;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
use App\Services\Customer\StoreService;
use App\Services\Customer\UpdateService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $customer = (new StoreService($data))->run();
        return (new CustomerResource($customer))->additional([
            'customer_balance' => new CustomerBalanceResource($customer->customer_balance)
        ]);
    }

    public function update(UpdateRequest $request, $customer_id)
    {
        $data = $request->all();
        $customer = $this->getCustomerById($customer_id);
        (new UpdateService($customer, $data))->run();
        return (new CustomerResource($this->getCustomerById($customer->id)))->additional([
            'customer_balance' => new CustomerBalanceResource($customer->customer_balance)
        ]);
    }

    public function getCustomer(GetCustomerRequest $request)
    {
        $customer = Customer::where('accountNumber', $request->accountNumber)->first();
        return (new CustomerResource($customer))->additional([
            'customer_balance' => new CustomerBalanceResource($customer->customer_balance)
        ]);
    }
}
