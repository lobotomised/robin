<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Past;
use Illuminate\Database\Eloquent\Factories\Factory;

class PastFactory extends Factory
{
    protected $model = Past::class;

    public function definition()
    {
        return [
            'encrypted' => $this->faker->sha256,
            'expire_at' => now(),
        ];
    }
}
