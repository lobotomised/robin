<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Past;
use Illuminate\Support\Facades\Log;

class DeleteExpiredPastAction
{
    private Past $past;

    public function __construct(Past $past)
    {
        $this->past   = $past;
    }

    public function delete(): void
    {
        $delete = $this->past::whereExpired()->delete();

        if ($delete > 0) {
            Log::info(sprintf('%s old pasts have been deleted', $delete));
        }
    }
}
