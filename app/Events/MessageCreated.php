<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $uidchat;

    public function __construct($message, $uidchat)
    {
        $this->message = $message;
        $this->uidchat = $uidchat;

    }

    public function broadcastOn(): array
    {
        return ['public', $this->uidchat];
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
