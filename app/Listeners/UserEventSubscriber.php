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

        $id = intval($event->user->id);

        $audit = Audit::create([
            'user_id' => $id,
            'event' => 'iniciando login',
        ]);


        if (isset($audit->id)) {
            $audit->update([
                'event'=>'login',
            ]);
        }
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout(Logout $event): void
    {
        $id = intval($event->user->id);
        Audit::create([
            'user_id' => $id,
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
