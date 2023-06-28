<?php

namespace App\Observers;

use App\Models\admins;
use App\Notifications\AdminRegisteredNotificationMail;

class UserObserver
{
    /**
     * Handle the admins "created" event.
     *
     * @param  \App\Models\admins  $admins
     * @return void
     */
    public function created(admins $admins)
    {
        $admins->notify(new AdminRegisteredNotificationMail($admins));
    }

    /**
     * Handle the admins "updated" event.
     *
     * @param  \App\Models\admins  $admins
     * @return void
     */
    public function updated(admins $admins)
    {
        //
    }

    /**
     * Handle the admins "deleted" event.
     *
     * @param  \App\Models\admins  $admins
     * @return void
     */
    public function deleted(admins $admins)
    {
        //
    }

    /**
     * Handle the admins "restored" event.
     *
     * @param  \App\Models\admins  $admins
     * @return void
     */
    public function restored(admins $admins)
    {
        //
    }

    /**
     * Handle the admins "force deleted" event.
     *
     * @param  \App\Models\admins  $admins
     * @return void
     */
    public function forceDeleted(admins $admins)
    {
        //
    }
}
