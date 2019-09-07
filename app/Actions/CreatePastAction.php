<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Past;
use Carbon\Carbon;

class CreatePastAction
{
    /**
     * @var \App\Models\Past
     */
    private $past;

    /**
     * CreatePastService constructor.
     *
     * @param \App\Models\Past $past
     */
    public function __construct(Past $past)
    {
        $this->past = $past;
    }

    /**
     * @param string $encrypted
     * @param \Carbon\Carbon $expire_at
     *
     * @return \App\Models\Past
     */
    public function __invoke(string $encrypted, Carbon $expire_at): Past
    {
        $this->past->encrypted = $encrypted;
        $this->past->expire_at = $expire_at;

        $this->past->save();

        return $this->past;
    }
}
