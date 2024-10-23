<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $book;

    public function __construct($user, $book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    public function build()
    {
        return $this->subject('Reminder: Book Return Due Soon')
                    ->view('emails.reminder') 
                    ->with([
                        'user' => $this->user,
                        'book' => $this->book,
                        
                    ])->from('mdhukka77@gmail.com','Haven Book');
                    
    }
}
