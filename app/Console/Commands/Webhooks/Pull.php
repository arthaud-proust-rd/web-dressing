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

    private $alreadyUpToDate;

    private $pullLog = [];

    private $composerLog = [];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

        if(!$this->runPull()) {

            $this->error("An error occurred while executing 'git pull'. \nLogs:");

            foreach($this->pullLog as $logLine) {
                $this->info($logLine);
            }

            return 1;
        }


        if($this->alreadyUpToDate) {
            $this->info("The application is already up-to-date");
            return 1;
        }


        if(!$this->runComposer()) {

            $this->error("Error while updating composer files. \nLogs:");

            foreach($this->composerLog as $logLine) {
                $this->info($logLine);
            }

            return 1;
        }

        $this->info("Succesfully updated the application.");
        return 0;
    }

    private function runPull(): bool
    {

        $process = new Process(['git', 'pull']);
        $this->info("Running 'git pull'");

        $process->run(function($type, $buffer) {
            $this->pullLog[] = $buffer;

            if($buffer === "Already up to date.\n") {
                $this->alreadyUpToDate = true;
            }

        });

        return $process->isSuccessful();

    }

    private function runComposer(): bool
    {

        $process = new Process(['composer', 'install']);
        $this->info("Running 'composer install'");

        $process->run(function($type, $buffer) {
            $this->composerLog[] = $buffer;
        });


        return $process->isSuccessful();
    }
}
