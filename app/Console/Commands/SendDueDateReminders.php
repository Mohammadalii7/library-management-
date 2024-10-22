<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BorrowingRecord; // Adjust according to your model
use App\Jobs\SendReminderEmail; // Make sure you create this job
use Carbon\Carbon;

// class SendDueDateReminders extends Command
// {
//     protected $signature = 'reminders:send';
//     protected $description = 'Send reminder emails for due dates';

//     public function handle()
//     {
//         $today = Carbon::today();

  
//         $dueRecords = BorrowingRecord::whereDate('due_date', $today)
//             ->with('member', 'book')
//             ->get();

//         if ($dueRecords->isEmpty()) {
//             $this->info('No due records found for today.');
//         } else {
//             foreach ($dueRecords as $record) {
                
//                 SendReminderEmail::dispatch($record->member, $record->book);

//                 $this->info('Reminder email dispatched to: ' . $record->member->email . ' for book: ' . $record->book->title);
//             }

//             $this->info('All reminder emails dispatched successfully!');
//         }
//     }
// }
