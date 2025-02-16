<?php

namespace App\Observers;

use App\Models\Calculation;
use App\Models\Measurement;

class MeasurementObserver
{
    public function created(Measurement $measurement): void
    {
        $lastMeasurement = Measurement::orderBy('time', 'desc')
            ->where('device_id', $measurement->device_id)
            ->where('time', '<', $measurement->time)
            ->first();

        if ($lastMeasurement) {
            Calculation::create([
                'device_id' => $measurement->device_id,
                'electricity' => $measurement->electricity - $lastMeasurement->electricity,
                'electricity_panel' => $measurement->electricity_panel - $lastMeasurement->electricity_panel,
                'gas' => $measurement->gas - $lastMeasurement->gas,
                'water' => $measurement->water - $lastMeasurement->water,
                'outside_temperature' => $measurement->outside_temperature - $lastMeasurement->outside_temperature,
                'time' => $measurement->time,
            ]);
        }
    }
}
