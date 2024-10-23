<?php

namespace App\Jobs;

use App\Mail\ReminderMail; // Ensure this exists
use App\Models\BorrowingRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected $member;
    protected $book;
    protected $dueDate;

    public function __construct($member, $book, $dueDate)
    {
        $this->member = $member;
        $this->book = $book;
        $this->dueDate = $dueDate;
    }

    public function handle()
    {
        try {

            
            Mail::to($this->member->email)->send(new ReminderMail($this->member, $this->book, $this->dueDate));

          

        } catch (\Throwable $th) {
            Log::error('Error sending reminder email: ' . $th->getMessage());
        }
    }
}
