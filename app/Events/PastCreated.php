<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Past;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PastCreated
{
    use Dispatchable, SerializesModels;

    /**
     * @var \App\Models\Past
     */
    public $past;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Past $past
     */
    public function __construct(Past $past)
    {
        $this->past = $past;
    }
}
