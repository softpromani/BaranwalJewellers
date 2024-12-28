<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

return function () {
    // Schedule the fetch:authority-rates command to run at 2 PM and 5 PM daily
    Artisan::command('fetch:authority-rates')->twiceDaily(14, 17);

    Log::info('Scheduled tasks registered successfully.');
};
