<?php

declare(strict_types=1);

namespace App\Actions;

use App\Events\PastCreated;
use App\Models\Past;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;

class CreatePastAction
{
    /**
     * @var \App\Models\Past
     */
    private $past;

    /**
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    private $dispatcher;

    /**
     * CreatePastService constructor.
     *
     * @param \App\Models\Past $past
     * @param \Illuminate\Contracts\Events\Dispatcher $dispatcher
     */
    public function __construct(Past $past, Dispatcher $dispatcher)
    {
        $this->past       = $past;
        $this->dispatcher = $dispatcher;
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

        $this->dispatcher->dispatch(new PastCreated($this->past));

        return $this->past;
    }
}
