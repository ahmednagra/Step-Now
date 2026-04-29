<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Double-Opt-In confirmation e-mail for newsletter sign-ups.
 *
 * The mail itself does not need explicit DSGVO consent (it is the
 * confirmation request — this is exactly what BGH I ZR 164/09 mandated).
 * However, the *content* must:
 *   - explain who is sending it and why,
 *   - contain a clear "Anmeldung bestätigen" link,
 *   - be in German,
 *   - mention the imprint / data controller.
 */
class NewsletterConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bitte bestätigen Sie Ihre Newsletter-Anmeldung',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter-confirmation',
            with: [
                'confirmUrl' => route('front.newsletter.confirm', $this->token),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
