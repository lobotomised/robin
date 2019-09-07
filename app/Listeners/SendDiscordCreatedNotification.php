<?php

declare(strict_types=1);

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(PastCreated $event): void
    {
        $message = sprintf("@everyone Un nouveau past a été publié à l'adresse %s", route('past.view', $event->past->id));

        $this->discord->send($message);
    }
}
