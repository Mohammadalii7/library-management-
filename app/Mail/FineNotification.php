<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FineNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $book;
    public $daysLate;
    public $fineAmount;

    public function __construct($user, $book, $daysLate, $fineAmount)
    {
        $this->user = $user;
        $this->book = $book;
        $this->daysLate = $daysLate;
        $this->fineAmount = $fineAmount;
        // dd($user, $book, $daysLate, $fineAmount);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Fine Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.fine_notification',
        );
    }

    public function build()
    {
        return $this->view('email.fine_notification')
        ->with([
            'user' => $this->user,
            'book' => $this->book,
            'fineAmount' => $this->fineAmount,
            'daysLate' => $this->daysLate
        ])
        ->from('mduhukka77@gmail.com', 'Book Haven');
    }
}
