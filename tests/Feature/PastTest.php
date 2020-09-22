<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Events\PastCreated;
use App\Models\Past;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

final class PastTest extends TestCase
{
    public function test_can_store_past(): void
    {
        Event::fake([
            PastCreated::class,
        ]);

        $past = new Past;

        $past->encrypted = 'message';
        $past->setExpireFromPeriode('1w');

        $past->save();

        $this->assertTrue($past->wasRecentlyCreated);
    }
}
