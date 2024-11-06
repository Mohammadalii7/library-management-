<?php

namespace App\Jobs;

use App\Mail\FineNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendFineNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    public $book;
    public $daysLate;
    public $fineAmount;

    /**
     * Create a new job instance.
     */
    public function __construct($user,$book,$daysLate,$fineAmount)
    {
        $this->user = $user;
        $this->book = $book;
        $this->daysLate = $daysLate;
        $this->fineAmount = $fineAmount;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $notificationEmail = new FineNotification($this->user, $this->book, $this->daysLate, $this->fineAmount);
        
        Mail::to($this->user->email)->send($notificationEmail);
    }
}
