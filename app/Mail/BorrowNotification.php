<?php

namespace App\Mail;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BorrowNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $book;

    /**
     * Create a new message instance.
     */
    public function __construct($user,$book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Book Borrow',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.borrow_notification',
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
    public function build()
    {
        $borrow = Book::with('user', 'book')->get();
        $user = $borrow->user;
        $book = $borrow->book;
        
             return $this->view('email.email.borrow_notification', compact('user', 'book'))
                    ->subject('Book Borrow Confirmation')   
                    ->from('mduhukka77@gmail.com', 'Book Haven');
    }
}
