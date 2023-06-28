<?php

namespace App\Events\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Src\main\Entities\User;

class Deleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    private User $target;

    /**
     * Create a new event instance.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->target = $model;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('broadcast-messages');
    }

    public function broadcastAs()
    {
        return 'users.deleted';
    }

    public function broadcastWith()
    {
        return [
            'user' => $this->target,
        ];
    }
}
