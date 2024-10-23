<?php

namespace App\Console\Commands;

use App\Jobs\SendReminderEmail;
use App\Models\BorrowingRecord;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Daily extends Command
{
    
    protected $signature = 'daily:cron';

    protected $description = 'Command description';

    public function handle()
    {
        try {

            Log::info('Daily Command Called: ');
            
            $today = date('Y-m-d');

    
            $dueRecords = BorrowingRecord::whereDate('due_date', $today)
                ->with('member', 'book') 
                ->get();

            if ($dueRecords->isEmpty()) {
                Log::info('No due records found for today.');
                return; 
            }


            foreach ($dueRecords as $record) {
                SendReminderEmail::dispatch($record->member, $record->book, $record->due_date);
                Log::info('Reminder email job dispatched for: ' . $record->member->email . ' for book: ' . $record->book->title);
            }

            Log::info('All reminder email jobs dispatched successfully!');


        } catch (\Throwable $th) {
            Log::info('Daily Command Error: ' . json_encode($th->getMessage()));
        }
    }
}
