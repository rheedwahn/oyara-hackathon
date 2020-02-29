<?php

namespace App\Http\Middleware;

use App\Enum\TransactionType;
use App\Models\Customer;
use App\Services\Transaction\TransactionChargeService;
use Closure;

class CustomerBalance
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
        if($request->transactionType === TransactionType::DEBIT) {
            $charge = (new TransactionChargeService($request->channel, $request->amount, $customer))->run();
            $total_amount = $request->amount + $charge;
            if($customer->customer_balance->availableBalance < $total_amount) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Your account balance is insufficient for this transaction'
                ]);
            }
        }
        return $next($request);
    }

}
