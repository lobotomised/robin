<?php

namespace App\Observers;

use App\Models\Past;
use App\Support\DiscordMessage;
use Illuminate\Notifications\Notifiable;

class PastObserver
{
    use Notifiable;

    /**
     * Handle the past "created" event.
     *
     * @param  \App\Models\Past  $past
     * @return void
     */
    public function created(Past $past)
    {
        (new DiscordMessage($past))->send();
    }

    /**
     * Handle the past "updated" event.
     *
     * @param  \App\Models\Past  $past
     * @return void
     */
    public function updated(Past $past)
    {
        //
    }

    /**
     * Handle the past "deleted" event.
     *
     * @param  \App\Models\Past  $past
     * @return void
     */
    public function deleted(Past $past)
    {
        //
    }

    /**
     * Handle the past "restored" event.
     *
     * @param  \App\Models\Past  $past
     * @return void
     */
    public function restored(Past $past)
    {
        //
    }

    /**
     * Handle the past "force deleted" event.
     *
     * @param  \App\Models\Past  $past
     * @return void
     */
    public function forceDeleted(Past $past)
    {
        //
    }
}
