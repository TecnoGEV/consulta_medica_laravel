<?php

namespace App\Listeners;

use App\Models\Audit;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserEventSubscriber
{
   /**
     * Handle user login events.
     */
    public function handleUserLogin(Login $event): void
    {
        $audit = Audit::create([
            'user_id' => $event->user->id,
            'event' => 'authentication',
        ]);

        dd($audit);
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout(Logout $event): void
    {
        Audit::create([
            'user_id' => $event->user->id,
            'event' => 'logout',
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            Login::class => 'handleUserLogin',
            Logout::class => 'handleUserLogout',
        ];
    }
}
