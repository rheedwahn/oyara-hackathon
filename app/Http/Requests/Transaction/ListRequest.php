<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
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
            'start_date' => 'sometimes|required',
            'end_date' => 'sometimes|required',
            'account_number' => 'sometimes|required',
            'channel' => 'sometimes|required',
            'reference' => 'sometimes|required'
        ];
    }
}
