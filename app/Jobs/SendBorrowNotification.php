<?php

namespace App\Jobs;

use App\Mail\BorrowNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendBorrowNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $book;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new BorrowNotification($this->user, $this->book));
    }
}
