<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Past;
use Carbon\Carbon;
use Psr\Log\LoggerInterface;

class DeleteExpiredPastAction
{
    /**
     * @var \App\Models\Past
     */
    private $past;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * DeleteExpiredPastAction constructor.
     *
     * @param \App\Models\Past $past
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(Past $past, LoggerInterface $logger)
    {
        $this->past   = $past;
        $this->logger = $logger;
    }

    /**
     *
     */
    public function delete(): void
    {
        $delete = $this->past->newQuery()->where('expire_at', '<=', Carbon::now())->delete();

        if ($delete > 0) {
            $this->logger->info(sprintf('% old pasts have been deleted', $delete));
        }
    }
}
