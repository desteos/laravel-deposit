<?php

namespace App\Listeners;

use App\Events\Transacted;
use App\Models\Transaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class TransactionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Transacted $event)
    {
        Transaction::create([
            'user_id' => $event->user_id,
            'wallet_id' => $event->wallet_id,
            'deposit_id' => $event->deposit_id,
            'amount' => $event->amount,
            'type' => $event->type,
        ]);
    }
}
