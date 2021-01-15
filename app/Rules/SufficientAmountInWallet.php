<?php

namespace App\Rules;

use App\Models\Wallet;
use Illuminate\Contracts\Validation\Rule;

class SufficientAmountInWallet implements Rule
{

    private $walletId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $walletId)
    {
        $this->walletId = $walletId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $wallet = Wallet::find($this->walletId);

        if($wallet->balance < $value){

            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have no enough money in wallet.';
    }
}
