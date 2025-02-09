<?php

namespace Database\Seeders;

use App\Models\Calculation;
use App\Models\Measurement;
use App\Observers\MeasurementObserver;
use Illuminate\Database\Seeder;

class CalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calculation::truncate();

        $measurements = Measurement::orderBy('id')->get();
        foreach ($measurements as $measurement) {
            (new MeasurementObserver())->created($measurement);
        }
    }
}
