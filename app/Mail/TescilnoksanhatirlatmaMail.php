<?php

namespace App\Mail;

use App\Models\Tescilnoksan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TescilnoksanhatirlatmaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tescilnoksan;
    public $tescilnoksansatistemsilcisi;
    public $tescilnoksanmusteri;

    public function __construct(Tescilnoksan $tescilnoksan , $type = null)
    {
        $this->tescilnoksan = $tescilnoksan;
        if ($type === 'satistemsilcisi') {
            $this->tescilnoksansatistemsilcisi = $tescilnoksan;
        } elseif ($type === 'musteri') {
            $this->tescilnoksanmusteri = $tescilnoksan;
        }
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Tescil Noksan Hatırlatma')
                    ->view('admin.mail.tescilnoksanhatirlatma')
                    ->with([
                        'tescilnoksansatistemsilcisi' => $this->tescilnoksansatistemsilcisi,
                        'tescilnoksanmusteri' => $this->tescilnoksanmusteri
                    ]);
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'TescilNoksan hatirlatma',
        );
    }


    public function content(): Content
    {
        return new Content(
            markdown: 'admin.mail.tescilnoksanhatirlatma',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
