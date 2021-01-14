<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Transacted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $deposit_id;
    public $wallet_id;
    public $user_id;
    public $amount;
    public $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $type, $amount, int $wallet_id, int $user_id, ?int $deposit_id = null)
    {
        $this->deposit_id = $deposit_id;
        $this->wallet_id = $wallet_id;
        $this->user_id = $user_id;
        $this->amount = $amount;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
