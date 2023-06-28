<?php

namespace App\Listeners;

use Illuminate\Support\Str;

class GenerateUuid
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event): void
    {
        $event->target->uuid = (string) Str::uuid();
    }
}
