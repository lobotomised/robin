<?php

namespace App\Listeners;

use App\Events\PastCreated;
use App\Support\DiscordMessage;

final class SendDiscordCreatedNotification
{
    /**
     * @var \App\Support\DiscordMessage
     */
    private $discord;

    /**
     * Create the event listener.
     *
     * @param \App\Support\DiscordMessage $discordMessage
     */
    public function __construct(DiscordMessage $discordMessage)
    {
        $this->discord = $discordMessage;
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\PastCreated $event
     *
     * @return void
     */
    public function handle(PastCreated $event)
    {
        $message = sprintf("@everyone Un nouveau past a été publié à l'adresse %s", route('past.view', $event->past));

        $this->discord->send($message);
    }
}
