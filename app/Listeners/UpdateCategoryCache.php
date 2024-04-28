<?php

namespace App\Listeners;

use App\Events\CategoryUpdated;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCategoryCache
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param CategoryUpdated $event
     * Handle the event.
     */
    public function handle(CategoryUpdated $event): void
    {
        Cache::forget('categories');
    }
}
