<?php

namespace App\Observers;

use App\Models\customers;
use App\Notifications\UserRegisteredNotificationMail;

class CilentObserver
{
    /**
     * Handle the customer "created" event.
     *
     * @param  \App\Models\customers  $customer
     * @return void
     */
    public function created(customers $customer)
    {
        $customer->notify(new UserRegisteredNotificationMail($customer));
    }

    /**
     * Handle the customer "updated" event.
     *
     * @param  \App\Models\customer  $customer
     * @return void
     */
    public function updated(customers $customer)
    {
        //
    }

    /**
     * Handle the customer "deleted" event.
     *
     * @param  \App\Models\customer  $customer
     * @return void
     */
    public function deleted(customers $customer)
    {
        //
    }

    /**
     * Handle the customer "restored" event.
     *
     * @param  \App\Models\customer  $customer
     * @return void
     */
    public function restored(customers $customer)
    {
        //
    }

    /**
     * Handle the customer "force deleted" event.
     *
     * @param  \App\Models\customer  $customer
     * @return void
     */
    public function forceDeleted(customers $customer)
    {
        //
    }
}
