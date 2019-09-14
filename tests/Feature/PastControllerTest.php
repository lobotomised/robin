<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Events\PastCreated;
use App\Models\Past;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PastControllerTest extends TestCase
{
    /**
     * @test
     */
    public function can_access_create_past(): void
    {
        $response = $this->get(route('past.create'));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_store_past(): void
    {
        $this->mock(HttpClient::class)
            ->shouldReceive('request')
            ->once()
            ->andReturn(new Response(200));

        $response = $this->json('POST', route('api.past.store'), [
            'expire'    => '1w',
            'encrypted' => 'data',
        ]);

        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function can_show_past(): void
    {
        Event::fake([
            PastCreated::class,
        ]);

        $past = factory(Past::class)->create();

        $response = $this->get(route('past.view', $past));

        $response->assertStatus(200);
    }
}
