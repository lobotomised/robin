<?php

namespace Tests\Feature;

use App\Entities\Past;
use App\Events\PastCreated;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PastControllerTest extends TestCase
{

    public function test_can_access_create_past()
    {
        $response = $this->get(route('past.create'));

        $response->assertStatus(200);
    }

    public function test_can_store_past()
    {
        $this->mock(HttpClient::class)
            ->shouldReceive('request')
            ->once()
            ->andReturn(new Response(200));

        $response = $this->json('POST', route('api.past.store'), [
            'expire' => '1w',
            'encrypted' => 'data'
        ]);

        $response->assertStatus(201);
    }

    public function test_can_show_past()
    {
        Event::fake([
            PastCreated::class
        ]);

        $past = entity(Past::class)->create();

        $response = $this->get(route('past.view', $past));

        $response->assertStatus(200);
    }
}
