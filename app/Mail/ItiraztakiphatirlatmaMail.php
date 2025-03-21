<?php

namespace App\Mail;

use App\Models\Itiraztakip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ItiraztakiphatirlatmaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $itiraztakip;
    public $itiraztakipsatistemsilcisi;
    public $itiraztakipmusteri;

    public function __construct(Itiraztakip $itiraztakip , $type = null)
    {
        $this->itiraztakip = $itiraztakip;
        if ($type === 'satistemsilcisi') {
            $this->itiraztakipsatistemsilcisi = $itiraztakip;
        } elseif ($type === 'musteri') {
            $this->itiraztakipmusteri = $itiraztakip;
        }
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('İtiraz Takip Hatırlatma')
                    ->view('admin.mail.itiraztakiphatirlatma')
                    ->with([
                        'itiraztakipsatistemsilcisi' => $this->itiraztakipsatistemsilcisi,
                        'itiraztakipmusteri' => $this->itiraztakipmusteri
                    ]);
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'İtiraztakip hatirlatma',
        );
    }


    public function content(): Content
    {
        return new Content(
            markdown: 'admin.mail.itiraztakiphatirlatma',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
