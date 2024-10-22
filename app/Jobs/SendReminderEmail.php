<?php

namespace App\Jobs;

use App\Mail\ReminderMail; // Ensure this exists
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected $user;
    protected $book;
    protected $dueDate;

    // public function __construct($user, $book, $dueDate)
    // {
    //     $this->user = $user;
    //     $this->book = $book;
    //     $this->dueDate = $dueDate; 
    // }

    // public function handle()
    // {
    //     // $today = now()->toDateString();

    //     if ($this->dueDate === now()) {
    //         Mail::to($this->user->email)->send(new ReminderMail($this->user, $this->book));
    //         // dd('test');
   
    //     }
    // }
}
