<?php

namespace App\Mail;

use App\Models\Show;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShowPublished extends Mailable
{
    use Queueable, SerializesModels;

    public $show;
    public $url;
    public $unsubscribeUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Show $show, ?string $unsubscribeUrl = null)
    {
        $this->show = $show;
        $this->url = route('shows.show', $show);
        $this->unsubscribeUrl = $unsubscribeUrl;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nuevo show: ' . $this->show->title)
                    ->view('emails.show_published')
                    ->with(['show' => $this->show, 'url' => $this->url, 'unsubscribeUrl' => $this->unsubscribeUrl]);
    }
}
