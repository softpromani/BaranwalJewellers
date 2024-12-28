<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\BusinessSetting;

class FetchAuthorityRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:fetch-authority';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch authority rates from API and update the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $apiUrl = 'https://api.metals.dev/v1/metal/authority';
        $apiKey = '5YZQ9MIBTU622GNCQR8V103NCQR8V';

        $authority = 'mcx';
        $currency = 'INR';
        $unit = 'g';

        $response = Http::get($apiUrl, [
            'api_key' => $apiKey,
            'authority' => $authority,
            'currency' => $currency,
            'unit' => $unit,
        ]);

        if ($response->successful()) {
            $responseData = $response->json();

            BusinessSetting::updateOrCreate(['key' => 'mcx_gold_rate'], ['value' => $responseData['rates']['mcx_gold']]);
            BusinessSetting::updateOrCreate(['key' => 'mcx_silver_rate'], ['value' => $responseData['rates']['mcx_silver']]);

            $this->info('Authority rates updated successfully.');
        } else {
            $this->error('Failed to fetch authority rates. Error: ' . $response->body());
        }

        return 0;
    }
}
