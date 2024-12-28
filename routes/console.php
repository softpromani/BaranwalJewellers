<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

Artisan::command('rates:fetch-authority', function () {
    $this->call('rates:fetch-authority');
})->describe('Fetch authority rates')->schedule(['--dailyAt' => ['14:00', '17:00']]);
