<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getCustomerById($customer_id)
    {
        return Customer::findOrFail($customer_id);
    }
}
