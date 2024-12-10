<?php

namespace Database\Seeders;

use App\Models\Carat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $carats = [
            ['name' => '24K', 'status' => '1'],
            ['name' => '22K', 'status' => '1'],
            ['name' => '18K', 'status' => '1'],
            ['name' => '14K', 'status' => '1'],
        ];

        foreach ($carats as $carat) {
            Carat::create($carat);
        }
    }
}
