<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\BusinessSetting;

class FetchAuthorityRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:authority-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches authority rates and updates business settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiUrl = 'https://api.metals.dev/v1/metal/authority';
        $apiKey = '5YZQ9MIBTU622GNCQR8V103NCQR8V';

        // Parameters
        $authority = 'mcx';
        $currency = 'INR';
        $unit = 'g';

        // Make the API request
        $response = Http::get($apiUrl, [
            'api_key' => $apiKey,
            'authority' => $authority,
            'currency' => $currency,
            'unit' => $unit,
        ]);

        // Handle the API response
        if ($response->successful()) {
            $responseData = $response->json();

            // Update the business settings
            BusinessSetting::updateOrCreate(['key' => 'mcx_gold_rate'], ['value' => $responseData['rates']['mcx_gold']]);
            BusinessSetting::updateOrCreate(['key' => 'mcx_silver_rate'], ['value' => $responseData['rates']['mcx_silver']]);

            $this->info('Authority rates fetched and updated successfully.');
        } else {
            $this->error('Failed to fetch authority rates. Error: ' . $response->body());
        }
    }
}
