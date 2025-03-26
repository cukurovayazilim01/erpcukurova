<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OdemeplanhatirlatmaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $odeme;

    public function __construct($odeme)
    {
        $this->odeme = $odeme;
    }

    public function build()
    {
        return $this->view('admin.mail.odemeplanhatirlatma')->with(['odeme' => $this->odeme]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Odeme Plan hatirlatma',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'admin.mail.odemeplanhatirlatma',
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
