<?php

namespace App\Services;

use App\Models\Wallet;

class WalletService
{
    public function increase(int $id, int $moneyCount)
    {
        $wallet = Wallet::find($id);

        $wallet->balance += $moneyCount;
        $wallet->save();

        //event enter
    }

    public function decrease(int $id, int $moneyCount)
    {
        $wallet = Wallet::find($id);

        $wallet->balance -= $moneyCount;
        $wallet->save();

        //event money out
    }
}
