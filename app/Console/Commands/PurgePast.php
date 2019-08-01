<?php

namespace App\Console\Commands;

use App\Models\Past;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PurgePast extends Command
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $deleted = Past::where('expire_at', '<', now())->delete();

        if ($deleted > 0) {
            Log::info(sprintf('%s pasts have been deleted', $deleted));
        }
    }
}
