<?php

declare(strict_types=1);

namespace App\Providers;

use App\Entities\Past;
use App\Repositories\PastRepository;
use App\Repositories\PastRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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

        // Tell doctrine to use this class for datetime column
        \Doctrine\DBAL\Types\Type::addType('uuid', \Ramsey\Uuid\Doctrine\UuidType::class);
    }
}
