<?php

namespace App\Mail;
use App\Models\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InquiryEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $inquiry;
    /* Create a new message instance */
    public function __construct(Enquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }
    /* Get the message envelope */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Inquiry Email',
        );
    }
    /* Get the message content definition */
    public function content(): Content
    {
        return new Content(
            view: 'admin.email.inquiry', // Use the correct view path
            with: ['inquiry' => $this->inquiry], // Pass the inquiry data to the view
        );
    }

    /**
     * Get the attachments for the message 
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}