<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposits';

    protected $fillable = [
        'user_id',
        'wallet_id',
        'invested',
        'percent',
        'duration',
        'accrue_times'
    ];

    const MIN = 10;
    const MAX = 100;
    const ACCRUE_COUNT_PER_DEPOSIT = 10;
    const DEPOSIT_PERCENT = 20;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
