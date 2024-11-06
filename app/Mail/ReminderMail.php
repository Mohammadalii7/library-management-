<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\BorrowingRecord;
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

    $dueRecords = BorrowingRecord::with('member', 'book')->first();
    $user = $dueRecords->member;
    $book = $dueRecords->book;
    
         return $this->view('emails.reminder', compact('user', 'book'))
                ->subject('Book Return Reminder');
               
                    
    }
}
