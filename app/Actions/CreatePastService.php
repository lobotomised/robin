<?php

declare(strict_types=1);

namespace App\Actions;

use App\Entities\Past;
use App\Events\PastCreated;
use App\Repositories\PastRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;

class CreatePastService
{
    /**
     * @var \App\Repositories\PastRepositoryInterface
     */
    private $past;
    /**
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    private $dispatcher;

    /**
     * CreatePastService constructor.
     *
     * @param \App\Repositories\PastRepositoryInterface $past
     * @param \Illuminate\Contracts\Events\Dispatcher $dispatcher
     */
    public function __construct(PastRepositoryInterface $past, Dispatcher $dispatcher)
    {
        $this->past = $past;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $encrypted
     * @param \Carbon\Carbon $expire_at
     *
     * @return \App\Entities\Past
     */
    public function __invoke(string $encrypted, Carbon $expire_at): Past
    {
        $past = new Past;

        $past->setEncrypted($encrypted);
        $past->setExpireAt($expire_at);

        $past = $this->past->save($past);
        
        $this->dispatcher->dispatch(new PastCreated($past));

        return $past;
    }
}
