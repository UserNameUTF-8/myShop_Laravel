<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class my_custom_command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:my_custom_command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom command for display message of tutorail';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Hello, this is my custom command!');
    }
}
