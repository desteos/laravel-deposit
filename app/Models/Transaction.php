<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'wallet_id',
        'deposit_id',
        'amount',
        'type',
    ];

    const TRANSACTION_INCREASE_BALANCE = 'enter';
    const TRANSACTION_CREATE_DEPOSIT = 'create_deposit';
    const TRANSACTION_ACCRUE = 'accrue';
    const TRANSACTION_CLOSE_DEPOSIT = 'close_deposit';

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }
}
