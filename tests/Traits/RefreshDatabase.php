<?php

declare(strict_types=1);

namespace Tests\Traits;

use Illuminate\Contracts\Console\Kernel;

trait RefreshDatabase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    /**
     * Begin a database transaction on the testing database.
     *
     * @return void
     */
    public function beginDatabaseTransaction(): void
    {
        $connection = $this->app->make('em')->getConnection();
        $connection->beginTransaction();

        $this->beforeApplicationDestroyed(function () use ($connection): void {
            $connection->rollBack();
        });
    }

    /**
     * Refresh the in-memory database.
     *
     * @return void
     */
    protected function refreshInMemoryDatabase(): void
    {
        $this->artisan('doctrine:schema:create');

        $this->app[Kernel::class]->setArtisan(null);
    }
}
