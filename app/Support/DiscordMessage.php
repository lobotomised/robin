<?php

declare(strict_types=1);

namespace App\Support;

use GuzzleHttp\Client as HttpClient;

final class DiscordMessage
{
    /**
     * API HTTP client.
     *
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * Discord API base URL.
     *
     * @var string
     */
    private $baseUrl;

    /**
     * @var string
     */
    private $webhook_token;

    /**
     * @var string
     */
    private $webhook_id;

    public function __construct(HttpClient $httpClient)
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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
            $this->httpClient->request('POST', $discord_url, $options);
        }
    }
}
