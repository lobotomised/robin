<?php

namespace App\Events;

use App\Models\Past;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

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
