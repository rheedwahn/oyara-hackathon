<?php

namespace App\Http\Middleware;

use App\Enum\CustomerStatus;
use App\Models\Customer;
use Closure;

class CheckCustomerStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $customer = Customer::findOrFail($request->customer_id);
        if($customer->status === CustomerStatus::INACTIVE || $customer->status === CustomerStatus::DORMANT) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction cannot be carried out on an inactive or dormant account'
            ]);
        }
        return $next($request);
    }
}
