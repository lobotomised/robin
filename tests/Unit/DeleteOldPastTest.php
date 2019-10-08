<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Actions\DeleteExpiredPastAction;
use App\Events\PastCreated;
use App\Models\Past;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class DeleteOldPastTest extends TestCase
{
    public function test_expired_past_should_be_deleted(): void
    {
        Event::fake([
            PastCreated::class,
        ]);

        $past = factory(Past::class)->create([
            'expire_at' => Carbon::now()->subMonth(),
        ]);

        app(DeleteExpiredPastAction::class)->delete();

        $this->assertDatabaseMissing('Pasts', [
            'id' => $past->id,
        ]);
    }

    public function test_unexpired_past_should_not_be_deleted(): void
    {
        Event::fake([
            PastCreated::class,
        ]);

        $past = factory(Past::class)->create([
            'expire_at' => Carbon::now()->addMonth(),
        ]);

        app(DeleteExpiredPastAction::class)->delete();

        $this->assertDatabaseHas('Pasts', [
            'id' => $past->id,
        ]);
    }
}
