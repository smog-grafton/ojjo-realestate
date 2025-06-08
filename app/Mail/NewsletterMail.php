<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Newsletter;
use App\Models\Subscriber;

class NewsletterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $newsletter;
    public $subscriber;
    public $unsubscribeUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Newsletter $newsletter, Subscriber $subscriber)
    {
        $this->newsletter = $newsletter;
        $this->subscriber = $subscriber;
        $this->unsubscribeUrl = route('newsletter.unsubscribe', [
            'email' => $subscriber->email,
            'token' => $subscriber->unsubscribe_token
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->newsletter->subject,
            to: $this->subscriber->email,
            replyTo: config('mail.from.address'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter',
            with: [
                'newsletter' => $this->newsletter,
                'subscriber' => $this->subscriber,
                'unsubscribeUrl' => $this->unsubscribeUrl,
                'content' => $this->processContent(),
            ]
        );
    }

    /**
     * Process newsletter content with subscriber-specific variables
     */
    private function processContent(): string
    {
        $content = $this->newsletter->content;
        
        // Replace common variables
        $variables = [
            '{{subscriber_name}}' => $this->subscriber->name ?? 'Valued Subscriber',
            '{{subscriber_email}}' => $this->subscriber->email,
            '{{unsubscribe_url}}' => $this->unsubscribeUrl,
            '{{newsletter_name}}' => $this->newsletter->name,
            '{{current_date}}' => now()->format('F j, Y'),
            '{{current_year}}' => now()->year,
        ];

        foreach ($variables as $variable => $value) {
            $content = str_replace($variable, $value, $content);
        }

        return $content;
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
