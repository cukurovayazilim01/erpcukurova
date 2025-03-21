<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TescilnoksanolusturmaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $tescilnoksanmail;

    public function __construct($tescilnoksanmail)
    {
        $this->tescilnoksanmail = $tescilnoksanmail;
    }

    public function build()
    {
        return $this->view('admin.mail.tescilnoksanolusturma')->with(['tescilnoksanmail' => $this->tescilnoksanmail]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tescil Noksan Oluşturma',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'admin.mail.tescilnoksanolusturma',
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
