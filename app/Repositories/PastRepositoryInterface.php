<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Past;

interface PastRepositoryInterface
{
    public function save(Past $past): Past;

    public function removeExpired(): int;
}
