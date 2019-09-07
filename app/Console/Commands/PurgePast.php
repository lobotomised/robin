<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\DeleteExpiredPastAction;
use Illuminate\Console\Command;

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
     * @var \App\Actions\DeleteExpiredPastAction
     */
    private $deletePast;

    /**
     * Create a new command instance.
     *
     * @param \App\Actions\DeleteExpiredPastAction $deletePast
     */
    public function __construct(DeleteExpiredPastAction $deletePast)
    {
        parent::__construct();
        $this->deletePast = $deletePast;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->deletePast->delete();
    }
}
