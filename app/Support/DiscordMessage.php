<?php

namespace App\Support;

use GuzzleHttp\Client as HttpClient;

class DiscordMessage
{
    /**
     * API HTTP client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * Discord API base URL.
     *
     * @var string
     */
    protected $baseUrl = 'https://discordapp.com/api';

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
        $this->httpClient = $httpClient;
        $this->baseUrl = config('services.discord.base_url');
        $this->webhook_id = config('services.discord.id');
        $this->webhook_token = config('services.discord.token');
    }

    public function send($message)
    {
        $discord_url = $this->baseUrl.'/webhooks/'.$this->webhook_id.'/'.$this->webhook_token;

        $payload = [
            'username' => config('app.name').' - notification',
            'content' => $message,
        ];

        $this->httpClient->request('POST', $discord_url, [
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
            'form_params' => $payload,
        ]);
    }
}
