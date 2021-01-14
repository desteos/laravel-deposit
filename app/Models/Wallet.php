<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
}
