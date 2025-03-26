<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class IsotakiphatirlatmaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $iso;

    public function __construct($iso)
    {
        $this->iso = $iso;
    }

    public function build()
    {
        return $this->view('admin.mail.isotakiphatirlatma')->with(['iso' => $this->iso]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'İso Belge hatirlatma',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'admin.mail.isotakiphatirlatma',
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
