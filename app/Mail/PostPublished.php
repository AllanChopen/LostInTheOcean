<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostPublished extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $url;
    public $unsubscribeUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Post $post, ?string $unsubscribeUrl = null)
    {
        $this->post = $post;
        $this->url = route('posts.show', $post);
        $this->unsubscribeUrl = $unsubscribeUrl;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nuevo artículo: ' . $this->post->title)
                    ->view('emails.post_published')
                    ->with(['post' => $this->post, 'url' => $this->url, 'unsubscribeUrl' => $this->unsubscribeUrl]);
    }
}
