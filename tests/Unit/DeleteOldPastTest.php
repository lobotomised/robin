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
    /**
     * @var \App\Actions\DeleteExpiredPastAction
     */
    private $deleteExpiredPastAction;

    public function setUp(): void
    {
        parent::setUp();
        $this->deleteExpiredPastAction = $this->app->make(DeleteExpiredPastAction::class);
    }

    /**
     * @test
     */
    public function expired_past_should_be_deleted(): void
    {
        Event::fake([
            PastCreated::class,
        ]);

        $past = factory(Past::class)->create([
            'expire_at' => Carbon::now()->subMonth(),
        ]);

        $this->deleteExpiredPastAction->delete();

        $this->assertDatabaseMissing('Pasts', [
            'id' => $past->id,
        ]);
    }
}
