<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Actions\CreatePastAction;
use App\Events\PastCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

final class PastTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_store_past(): void
    {
        Event::fake([
            PastCreated::class,
        ]);

        $past = (new CreatePastAction)->handle('message', '1w');

        $this->assertTrue($past->wasRecentlyCreated);

        $this->assertDatabaseHas('pasts', [
            'encrypted' => 'message',
        ]);
    }
}
