<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;

class CurrencyMiddleware
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
        if($customer->currency != $request->currency) {
            return response()->json([
                'status' => 'error',
                'message' => 'Currency must be equal to customers currency'
            ]);
        }
        return $next($request);
    }
}
