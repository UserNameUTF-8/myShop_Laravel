<?php

namespace App\Listeners;

use App\Events\LogInHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class LogInHistoryListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LogInHistory $event): void
    {
        $user = $event->getUser();
        DB::insert('insert into user_history values (?, NOW(), NULL, NULL)', [$user->id]);
    }
}
