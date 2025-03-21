<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BasvuruMail extends Mailable
{
    use Queueable, SerializesModels;

    public $randevu;

    public function __construct($randevu)
    {
        $this->randevu = $randevu;
    }

    public function build()
    {
        return $this->view('emails.randevu')->with(['randevu' => $this->randevu]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Randevu İsteği',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.randevu',
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
