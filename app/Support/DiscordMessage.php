<?php

namespace App\Support;

use App\Models\Past;
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
    private $channel;

    /**
     * @var string
     */
    private $webhook_token;

    /**
     * @var string
     */
    private $webhook_id;
    /**
     * @var \App\Models\Past
     */
    private $past;

    public function __construct(Past $past)
    {
        $this->httpClient = new HttpClient([
            'headers' => [
                'Content-Type' => 'multipart/form-data'
            ]
        ]);
        $this->baseUrl = 'https://discordapp.com/api';
        $this->channel = config('services.discord.channel');
        $this->webhook_id = config('services.discord.id');
        $this->webhook_token = config('services.discord.token');
        $this->past = $past;
    }


    public function send()
    {
        $discord_url = $this->baseUrl.'/webhooks/'.$this->webhook_id.'/'.$this->webhook_token;

        $data = [
            'username' => config('app.name'),
            'content' => sprintf("Un nouveau past a été publié à l'adresse %s", route('past.view', $this->past))
        ];

        return $this->httpClient->post(
            $discord_url,
            [ 'form_params' => $data ]
        );

    }
}
