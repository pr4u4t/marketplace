<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\ProductCreated;
use Illuminate\Support\Facades\Cache;

class NewProductSubscriber{
    
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function onNewProductCreated(ProductCreated $event){
        //
        Cache::forget('products:front:newest');
        //Cache::forget('');
    }
    
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events){
        $events->listen(
            'App\Events\ProductCreated',
            'App\Listeners\NewProductSubscriber@onNewProductCreated'
        );
    }
}
