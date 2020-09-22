<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Events\PastCreated;
use App\Models\Past;
use Illuminate\Support\Facades\Event;
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
        Event::fake([
            PastCreated::class,
        ]);

        $response = $this->json('POST', route('api.past.store'), [
            'expire'    => '1w',
            'encrypted' => 'data',
        ]);

        $response->assertStatus(201);
    }

    public function test_can_show_past(): void
    {
        Event::fake([
            PastCreated::class,
        ]);

        $past = Past::factory()->create();

        $response = $this->get(route('past.view', $past));

        $response->assertStatus(200);
    }
}
