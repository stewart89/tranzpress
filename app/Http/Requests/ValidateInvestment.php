<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateInvestment extends FormRequest
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
            'name' => 'required',
            'investment_type' => 'required',
            'transaction_date' => 'required',
            'amount' => 'required|numeric',
            'currency' => 'required',
            'exchange_rate' => 'numeric|nullable',
            'quantity' => 'required|numeric',
            'anual_income' => 'required|max:14',
            'term' => 'max:6|nullable',
        ];
    }
}
