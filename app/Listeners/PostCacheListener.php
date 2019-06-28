<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Post;

class PostCacheListener
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
    public function handle($event)
    {

        cache()->forget('posts');
        $db=Post::with('category', 'user')->select('id', 'title', 'category_id', 'created_at', 'user_id')->take(40)->get();


        cache()->forever('posts', $db);



    }
}
