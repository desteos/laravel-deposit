<?php

namespace App\Services;

use App\Events\Transacted;
use App\Models\Transaction;
use App\Models\Wallet;

class WalletService
{
    public function increase(int $id, int $amount):void
    {
        $wallet = Wallet::find($id);

        $wallet->balance += $amount;
        $wallet->save();

        event(new Transacted(Transaction::INCREASE_BALANCE, $amount, $wallet->user_id, $id));
    }

    public function decrease(int $id, int $amount):void
    {
        $wallet = Wallet::find($id);

        $wallet->balance -= $amount;
        $wallet->save();
    }
}
