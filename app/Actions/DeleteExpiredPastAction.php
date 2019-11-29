<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Past;
use Psr\Log\LoggerInterface;

class DeleteExpiredPastAction
{
    /**
     * @var \App\Models\Past
     */
    private Past $past;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private LoggerInterface $logger;

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
     * @throws \Exception
     */
    public function delete(): void
    {
        $delete = $this->past->whereExpired()->delete();

        if ($delete > 0) {
            $this->logger->info(sprintf('% old pasts have been deleted', $delete));
        }
    }
}
