<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $email,
        public string $confirmUrl,
        public string $unsubUrl,
        public string $locale = 'de',
    ) {}

    public function build()
    {
        $subject = $this->locale === 'en'
            ? 'Please confirm your subscription — StepNow'
            : 'Bitte bestätigen Sie Ihre Anmeldung — StepNow';

        return $this->subject($subject)
            ->view('emails.newsletter-confirm')
            ->with([
                'confirmUrl' => $this->confirmUrl,
                'unsubUrl'   => $this->unsubUrl,
                'locale'     => $this->locale,
            ]);
    }
}
