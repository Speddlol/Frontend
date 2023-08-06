<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CoinFlipGameCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $message;
    /**
     * Create a new event instance.
     */
    public function __construct($game)
    {
        $this->message = $game;
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    public function broadcastAs() {
        return 'CoinFlipGameCreatedEvent';
    }
      
    public function broadcastOn() { // use PrivateChannel to create channels only for auth users
        return new Channel('CoinFlipGameCreated'); // enter channel name
    }
}
