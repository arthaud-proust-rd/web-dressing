<?php

namespace App\Console\Commands\Webhooks;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

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
        $process = Process::fromShellCommandline('git pull');
        return 0;
    }
}
