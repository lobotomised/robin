<?php

namespace App\Console\Commands;

use App\Models\Past;
use App\Repositories\PastRepositoryInterface;
use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;

final class PurgePast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'past:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete pasts that have expired';

    /**
     * @var \App\Repositories\PastRepositoryInterface
     */
    private $pastRepository;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Create a new command instance.
     *
     * @param \App\Repositories\PastRepositoryInterface $pastRepository
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(PastRepositoryInterface $pastRepository, LoggerInterface $logger)
    {
        parent::__construct();
        $this->pastRepository = $pastRepository;
        $this->logger = $logger;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $deleted = $this->pastRepository->removeExpired();

        if ($deleted > 0) {
            $this->logger->info(sprintf('%s pasts have been deleted', $deleted));
        }

    }
}
