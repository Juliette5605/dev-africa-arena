<?php
namespace App\Mail;
use App\Models\Candidature;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
class CandidatureConfirmation extends Mailable {
    use Queueable, SerializesModels;
    public function __construct(public Candidature $candidature) {}
    public function envelope(): Envelope {
        return new Envelope(subject: ' Candidature reçue — DevAfricaArena 2026');
    }
    public function content(): Content {
        return new Content(view: 'emails.candidature-confirmation');
    }
}
