<?php

declare(strict_types=1);

namespace App\Providers;

use App\Entities\Past;
use App\Repositories\PastRepository;
use App\Repositories\PastRepositoryInterface;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Ramsey\Uuid\Doctrine\UuidType;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(PastRepositoryInterface::class, static function ($app) {
            return new PastRepository(
                $app['em'],
                $app['em']->getClassMetaData(Past::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws \Doctrine\DBAL\DBALException
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Create some custom type for doctrine

        // During test, look like it is loaded multiple type
        if (! Type::hasType('uuid')) {
            Type::addType('uuid', UuidType::class);
        }
    }
}
