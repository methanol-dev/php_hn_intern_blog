<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Report extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $user;
    private $posts;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $posts)
    {
        $this->user = $user;
        $this->posts = $posts;
        $this->queue = 'sendmail';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.report')
            ->with([
                'user' => $this->user,
                'posts' => $this->posts,
            ]);
    }
}
