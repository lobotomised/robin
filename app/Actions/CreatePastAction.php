<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Past;

final class CreatePastAction
{
    public function handle(string $message, string $expire): Past
    {
        $past = new Past();

        $past->encrypted = $message;
        $past->setExpireFromPeriode($expire);

        $past->save();

        return $past;
    }
}
