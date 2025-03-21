<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ItiraztakipolusturmaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $itiraztakipmail;

    public function __construct($itiraztakipmail)
    {
        $this->itiraztakipmail = $itiraztakipmail;
    }

    public function build()
    {
        return $this->view('admin.mail.itiraztakipolusturma')->with(['itiraztakipmail' => $this->itiraztakipmail]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'İtiraz Takip Oluşturma',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'admin.mail.itiraztakipolusturma',
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
