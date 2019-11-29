<?php

declare(strict_types=1);

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Past;
use Faker\Generator as Faker;

$factory->define(Past::class, static function (Faker $faker) {
    return [
        'encrypted' => $faker->sha256,
        'expire_at' => now(),
    ];
});
