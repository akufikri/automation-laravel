<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use \Jenssegers\Agent\Facades\Agent;

class LoginListener
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
    public function handle(LoginEvent  $event): void
    {
        $time = Carbon::now()->toDateTimeLocalString();
        $browser = Agent::browser();
        DB::table('history_logins')->insert([
                'name' => $event->name,
                'email' => $event->email,
                'role' => $event->role,
                'ip_address' => request()->ip(),
                'browser' => $browser,
                'created_at' => $time,
        ]);
    }
}