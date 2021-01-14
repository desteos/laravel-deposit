<?php

namespace App\Services;

use App\Models\Deposit;

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

        $deposit->invested += $amount * 1; //to get only positive numbers todo refactor

        $this->walletService->decrease($deposit->wallet_id, $amount);

        //event
    }

    public function store(int $walletId, int $amount)
    {
        $user = auth()->user();

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

        //todo event create_deposit

        return $deposit;
    }

    public function accrue(Deposit $deposit)
    {
        if(!$deposit->active){
            return false;
        }

        $deposit->wallet->balance += $deposit->invested / 100 * Deposit::DEPOSIT_PERCENT;
        $deposit->wallet->save();

        $deposit->accrue_times++;

        if($deposit->accrue_times === $deposit->duration){
            $deposit->active = 0;
        }

        $deposit->save();

        //todo  event accrue
    }

    public function close(int $id)
    {
        $deposit = Deposit::find($id);

        $deposit->active = 0;

        $deposit->save();

        //todo event close_deposit
    }
}
