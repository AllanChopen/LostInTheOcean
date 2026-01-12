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
        if (! isset($show->status) || $show->status === 'upcoming') {
            $this->sendToSubscribers($show);
        }
    }

    /**
     * Handle the Show "updated" event.
     * If the status transitioned to 'upcoming', notify subscribers.
     */
    public function updated(Show $show): void
    {
        $original = $show->getOriginal('status');
        $current = $show->status;

        if (($original !== 'upcoming') && ($current === 'upcoming')) {
            $this->sendToSubscribers($show);
        }
    }

    /**
     * Send the show published mail to active subscribers in chunks.
     */
    private function sendToSubscribers(Show $show): void
    {
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
