<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount'                => 'required',
            'transaction_type',
            'user_id',
            'free',
            'date',
        ];

    }

    public function messages()
    {
        return [
            'transaction_type'     => 'Transaction Type field is required',
        ];
    }
}
