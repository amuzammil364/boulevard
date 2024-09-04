<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendReceiptEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $total;
    public $payment_id;
    /**
     * Create a new message instance.
     */
    public function __construct($data , $total , $payment_id)
    {
        $this->data = $data;
        $this->total = $total;
        $this->payment_id = $payment_id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Boulevard Receipt',
            from: new Address('no-reply@safariboulevard.pk', 'Boulevard Receipt'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.send_receipt',
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
