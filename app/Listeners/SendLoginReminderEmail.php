<?php

namespace App\Listeners;

use App\Jobs\SendReminderEmail;
use App\Models\BorrowingRecord;
use Illuminate\Auth\Events\Login;

class SendLoginReminderEmail
{
    // public function handle(Login $event)
    // {
    //     $user = $event->user;

    //     $borrowingRecords = BorrowingRecord::where('member_id', $user->id)
    //         ->with('book')
    //         ->get();

    //     foreach ($borrowingRecords as $record) {
    //         SendReminderEmail::dispatch($user, $record->book);
    //     }
    // }
}
