<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use App\Events\LogInHistory;
use App\Models\User;

class history extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:history';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::all()->first();
        
        event(new LogInHistory($user));
    }
}
