<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Login; // Add this if not present

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Registering the listener for user login
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\SendLoginReminderEmail',
        ],
    ];

    // Other code ...
}