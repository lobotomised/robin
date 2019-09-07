<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Past;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class PastControllerTest extends TestCase
{
    public function test_can_access_create_past(): void
    {
        $response = $this->get(route('past.create'));

        $response->assertStatus(200);
    }

    public function test_can_store_past(): void
    {
        $this->mock(HttpClient::class)
            ->shouldReceive('request')
            ->andReturn(new Response(200));

        $response = $this->json('POST', route('api.past.store'), [
            'expire'    => '1w',
            'encrypted' => 'data',
        ]);

        $response->assertStatus(201);
    }

    public function test_can_show_past(): void
    {
        $this->mock(HttpClient::class)
            ->shouldReceive('request')
            ->andReturn(new Response(200));

        $past = factory(Past::class)->create();

        $response = $this->get(route('past.view', $past));

        $response->assertStatus(200);
    }
}
