<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Http;

final class DiscordMessage
{
    /**
     * @var \Illuminate\Support\Facades\Http
     */
    private Http $httpClient;

    /**
     * Discord API base URL.
     *
     * @var string
     */
    private string $baseUrl;

    /**
     * @var string
     */
    private string $webhook_token;

    /**
     * @var string
     */
    private string $webhook_id;

    /** @noinspection PhpStrictTypeCheckingInspection */
    public function __construct(Http $httpClient)
    {
        $this->httpClient    = $httpClient;
        $this->baseUrl       = config('services.discord.base_url');
        $this->webhook_id    = config('services.discord.id');
        $this->webhook_token = config('services.discord.token');
    }

    /**
     * Ping a message on discord
     *
     * @param $message
     *
     */
    public function send($message): void
    {
        $discord_url = $this->baseUrl.'/webhooks/'.$this->webhook_id.'/'.$this->webhook_token;

        $payload = [
            'username' => config('app.name').' - notification',
            'content'  => $message,
        ];

        $options = [
            'headers'     => ['Content-Type' => 'application/x-www-form-urlencoded'],
            'form_params' => $payload,
        ];

        if (config('services.discord.enabled')) {
            $this->httpClient::withHeaders($options)->post($discord_url, $payload);
        }
    }
}
