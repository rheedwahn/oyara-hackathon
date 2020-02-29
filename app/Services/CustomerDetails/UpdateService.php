<?php

namespace App\Services\CustomerDetails;

use Illuminate\Support\Arr;

class UpdateService
{
    protected $customer;
    protected $data;

    const UPDATE_FIELDS = ['availableBalance', 'clearedBalance', 'unclearBalance', 'holdBalance', 'minimumBalance'];

    public function __construct($customer, $data)
    {
        $this->customer = $customer;
        $this->data = $data;
    }

    public function run()
    {
        return $this->updateModel($this->customer, self::UPDATE_FIELDS, $this->data);
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
