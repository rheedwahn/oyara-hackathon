<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'accountName' => 'sometimes|required|string',
            'currency' => 'sometimes|required|string',
            'lastTransactionDate' => 'sometimes|required|date_format:Y-m-d',
            'accountType' => 'sometimes|required',
            'bvn' => [
                'sometimes',
                'required',
                'digits:11',
                Rule::unique('customers','id')->ignore($this->customer_id)
            ],
            'fullname' => 'sometimes|required|string',
            'phoneNumber' => 'sometimes|required',
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('customers','id')->ignore($this->customer_id)
            ],
        ];
    }
}
