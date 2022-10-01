<?php

namespace App\Console\Commands\Webhooks;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Pull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webhook:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        return 0;
    }
}
