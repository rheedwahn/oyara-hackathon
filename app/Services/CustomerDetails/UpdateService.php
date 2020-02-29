<?php

namespace App\Services\CustomerDetails;

use Illuminate\Support\Arr;

class UpdateService
{
    protected $customer_balance;
    protected $data;

    const UPDATE_FIELDS = ['availableBalance', 'clearedBalance', 'unclearBalance', 'holdBalance', 'minimumBalance'];

    public function __construct($customer_balance, $data)
    {
        $this->customer_balance = $customer_balance;
        $this->data = $data;
    }

    public function run()
    {
        return $this->updateModel($this->customer_balance, self::UPDATE_FIELDS, $this->data);
    }

    private function updateModel($model, $update_fields, $data)
    {
        foreach ($update_fields as $key) {
            if (Arr::has($data, $key)) {
                $model->setAttribute($key, $data[$key]);
            }
        }
        //save will only actually save if the model has changed
        $model->save();
    }
}
