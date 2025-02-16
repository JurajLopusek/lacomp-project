<?php

namespace Database\Seeders;

use App\Models\Device;
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
        $device = Device::factory()->fullData()->create();
        $measurement = Measurement::factory()->setDevice($device)->create();

        for ($i = 1; $i <= 4500; $i++) {
            $measurement = Measurement::factory()->setDevice($device)->setMeasurements($measurement)->create();
        }
    }
}
