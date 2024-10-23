<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Artisan::command('daily:cron', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->everyThirtySeconds();


// Log::info('Command Called 11: ');


// Artisan::command('daily:cron', function () {
//     $this->comment(Inspiring::quote());
// })->everyThirtySeconds();

Schedule::command("daily:cron")->everyThirtySeconds();