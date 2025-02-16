<?php

namespace Database\Seeders;

use App\Models\Measurement;
use Illuminate\Database\Seeder;
use Throwable;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Throwable
     */
    public function run(): void
    {
        $measurement = Measurement::factory()->createQuietly();

        for ($i = 1; $i <= 200; $i++) {
            Measurement::factory()->setDevice($measurement->device)->setMeasurements($measurement)->createQuietly();
        }
    }
}
