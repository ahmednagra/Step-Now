<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InquiryNotification extends Notification
{
    use Queueable;

    protected $inquiry;

    /**
     * Create a new notification instance.
     */
    public function __construct($inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Inquiry Received')
                    ->line('You have received a new inquiry from ' . $this->inquiry->name)
                    ->line('Message: ' . $this->inquiry->enquiry_message)
                    // ->action('View Inquiry', url('/inquiries/' . $this->inquiry->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'name' => $this->inquiry->name,
            'email' => $this->inquiry->email,
            'phone' => $this->inquiry->phone_no,
            'message' => $this->inquiry->enquiry_message,
            'inquiry_id' => $this->inquiry->id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'name' => $this->inquiry->name,
            'message' => $this->inquiry->enquiry_message,
        ];
    }
}
