<?php

namespace Database\Seeders;

use App\Models\Measurement;
use Illuminate\Database\Seeder;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $measurement = Measurement::factory()->create();

        for ($i = 1; $i <= 20; $i++) {
            Measurement::factory()->setDevice($measurement->device)->setMeasurements($measurement)->create();
        }
    }
}
