<?php

namespace App\Http\Requests;

use App\Models\Deposit;
use App\Rules\SufficientAmountInWallet;
use Illuminate\Foundation\Http\FormRequest;

class StoreDepositRequest extends FormRequest
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
            'amount' => [
                'required',
                'numeric',
                'between:'.Deposit::MIN.','.Deposit::MAX,
                new SufficientAmountInWallet($this->wallet_id)
            ],
        ];
    }
}
