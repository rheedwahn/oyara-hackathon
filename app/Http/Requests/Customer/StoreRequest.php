<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'accountName' => 'required|string',
            'currency' => 'required|string',
            'accountType' => 'required',
            'bvn' => 'required|digits:11|unique:customers,bvn',
            'fullname' => 'required|string',
            'phoneNumber' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:customers,email'
        ];
    }
}
