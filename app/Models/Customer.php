<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function customer_balance()
    {
        return $this->hasOne(CustomerBalance::class, 'accountNumber', 'accountNumber');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'accountNumber', 'accountNumber');
    }
}
