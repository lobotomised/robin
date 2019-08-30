<?php

namespace App\Events;

use App\Entities\Past;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PastCreated
{
    use Dispatchable, SerializesModels;

    /**
     * @var \App\Entities\Past
     */
    public $past;

    /**
     * Create a new event instance.
     *
     * @param \App\Entities\Past $past
     */
    public function __construct(Past $past)
    {
        $this->past = $past;
    }
}
