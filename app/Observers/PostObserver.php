<?php

namespace App\Observers;

use App\Mail\PostPublished;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        // If the model has a status field, only send when published
        if (isset($post->status) && $post->status !== 'published') {
            return;
        }

        Subscriber::where('is_active', true)
            ->chunk(100, function ($subscribers) use ($post) {
                foreach ($subscribers as $subscriber) {
                    try {
                        $unsubscribe = \Illuminate\Support\Facades\URL::signedRoute('unsubscribe', ['email' => $subscriber->email]);
                        Mail::to($subscriber->email)->send(new PostPublished($post, $unsubscribe));
                    } catch (\Exception $e) {
                        // Fail silently; don't break the loop
                    }
                }
            });
    }
}
