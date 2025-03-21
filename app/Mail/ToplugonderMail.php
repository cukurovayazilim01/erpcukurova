<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ToplugonderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $toplumail;


    public function __construct($toplumail)
    {
        $this->toplumail = $toplumail;
    }

    public function build()
    {
        return $this->view('admin.mail.toplumailgonderme')
        ->with(['toplumail' => $this->toplumail]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Toplu Mail Gönderimi',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'admin.mail.toplumailgonderme',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
