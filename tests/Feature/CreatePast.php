<?php

namespace Tests\Feature;

use App\Models\Past;
use Tests\TestCase;

class PastControllerTest extends TestCase
{

    public function test_can_create_past()
    {
        $response = $this->json('POST', route('api.past.store'), [
            'expire' => '1w',
            'encrypted' => 'data'
        ]);

        $response->assertStatus(201);
    }

    public function test_can_show_past()
    {
        $past = factory(Past::class)->create();

        $response = $this->get(route('past.view', $past));

        $response->assertStatus(200);
    }
}
