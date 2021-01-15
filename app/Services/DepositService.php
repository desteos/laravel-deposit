<?php

namespace App\Services;

use App\Events\Transacted;
use App\Models\Deposit;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DepositService
{
    private $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function update(int $id, int $amount)
    {
        $deposit = Deposit::find($id);

        $deposit->invested += $amount;

        $this->walletService->decrease($deposit->wallet_id, $amount);

        //event
    }

    public function store(int $walletId, int $amount)
    {
        $user = Auth::user();

        $deposit = Deposit::create([
            'wallet_id' => $walletId,
            'user_id'   => $user->id,
            'invested'  => $amount,
            'percent'   => Deposit::DEPOSIT_PERCENT,
            'duration'  => Deposit::ACCRUE_COUNT_PER_DEPOSIT
        ]);

        if(empty($deposit)){
            return false;
        }

        $this->walletService->decrease($walletId, $amount);

        event(new Transacted(Transaction::CREATE_DEPOSIT, $amount, $user->id, $walletId, $deposit->id));

        return $deposit;
    }

    public function accrue(Deposit $deposit)
    {
        if(!$deposit->active){
            return false;
        }

        $wallet = $deposit->wallet;

        $amount = $deposit->invested / 100 * $deposit->percent;

        $wallet->balance += $amount;
        $wallet->save();

        $deposit->accrue_times++;

        event(new Transacted(Transaction::ACCRUE, $amount, $deposit->user_id, $wallet->id, $deposit->id));

        if($deposit->accrue_times === $deposit->duration){
            $deposit->active = 0;

            event(new Transacted(Transaction::CLOSE_DEPOSIT, 0, $deposit->user_id, $wallet->id, $deposit->id));
        }

        $deposit->save();
    }
}
