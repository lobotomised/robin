<?php

declare(strict_types=1);

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Entities\Past;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Past::class, static function (Faker $faker) {
    return [
        'encrypted'  => $faker->sha256,
        'created_at' => Carbon::now(),
        'expire_at'  => Carbon::now(),
    ];
});
