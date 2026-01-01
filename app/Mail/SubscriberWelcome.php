<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class SubscriberWelcome extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;
    public $unsubscribeUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
        $this->unsubscribeUrl = URL::signedRoute('unsubscribe', ['email' => $subscriber->email]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bienvenido al canal de noticias — Lost In The Ocean')
                    ->view('emails.subscriber_welcome')
                    ->with(['unsubscribeUrl' => $this->unsubscribeUrl]);
    }
}
