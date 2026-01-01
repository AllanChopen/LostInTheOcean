<?php

namespace App\Observers;

use App\Mail\ShowPublished;
use App\Models\Show;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class ShowObserver
{
    /**
     * Handle the Show "created" event.
     */
    public function created(Show $show): void
    {
        // The Shows use statuses like 'upcoming', 'sold_out', 'cancelled', 'past'.
        // Send notifications when a show is announced as 'upcoming'.
        if (isset($show->status) && $show->status !== 'upcoming') {
            return;
        }

        Subscriber::where('is_active', true)
            ->chunk(100, function ($subscribers) use ($show) {
                foreach ($subscribers as $subscriber) {
                    try {
                        $unsubscribe = \Illuminate\Support\Facades\URL::signedRoute('unsubscribe', ['email' => $subscriber->email]);
                        Mail::to($subscriber->email)->send(new ShowPublished($show, $unsubscribe));
                    } catch (\Exception $e) {
                        // ignore individual failures
                    }
                }
            });
    }
}
