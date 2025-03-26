<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TahsilatplanhatirlatmaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tahsilat;

    public function __construct($tahsilat)
    {
        $this->tahsilat = $tahsilat;
    }

    public function build()
    {
        return $this->view('admin.mail.tahsilatplanhatirlatma')->with(['tahsilat' => $this->tahsilat]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'TahsilatPlan hatirlatma',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'admin.mail.tahsilatplanhatirlatma',
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
