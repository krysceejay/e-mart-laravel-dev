<?php

namespace App\Observers;

use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ItemObserver
{
    /**
     * Handle the item "created" event.
     *
     * @param  \App\Item  $item
     * @return void
     */

     public function creating(Item $item)
     {
         $random_str = Str::lower(Str::random(6));
         $slug = Str::slug($item->name, '-');
         $item->slug = $slug.'-'.$random_str;
         $item->user_id = Auth::user()->id;
     }

    public function created(Item $item)
    {
        //
    }

    /**
     * Handle the item "updated" event.
     *
     * @param  \App\Item  $item
     * @return void
     */
    public function updated(Item $item)
    {
        //
    }

    /**
     * Handle the item "deleted" event.
     *
     * @param  \App\Item  $item
     * @return void
     */
    public function deleted(Item $item)
    {
        //
    }

    /**
     * Handle the item "restored" event.
     *
     * @param  \App\Item  $item
     * @return void
     */
    public function restored(Item $item)
    {
        //
    }

    /**
     * Handle the item "force deleted" event.
     *
     * @param  \App\Item  $item
     * @return void
     */
    public function forceDeleted(Item $item)
    {
        //
    }
}
