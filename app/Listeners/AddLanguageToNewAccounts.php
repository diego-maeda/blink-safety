<?php

namespace App\Listeners;

use App\Models\Language;
use \Illuminate\Auth\Events\Registered;

class AddLanguageToNewAccounts
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        // Sets a new language for the customer after register
        Language::create([
            'user_id' => $event->user->id,
            'language' => 'en'
        ]);
    }
}
