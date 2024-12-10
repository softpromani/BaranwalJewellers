<?php

namespace Database\Seeders;

use App\Models\Metal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
$metals = [
    ['name' => 'gold', 'status' => '1'],
    ['name' => 'silver', 'status' => '1'],
];

foreach ($metals as $metal) {
    Metal::create($metal);
}

    }
}
