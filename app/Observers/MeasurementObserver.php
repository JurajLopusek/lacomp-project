<?php

namespace App\Observers;

use App\Models\Calculation;
use App\Models\Measurement;

class MeasurementObserver
{
    /**
     * Handle the Measurement "created" event.
     */
    public function created(Measurement $measurement): void
    {
        $lastMeasurement = Measurement::orderBy('time', 'desc')
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

    /**
     * Handle the Measurement "updated" event.
     */
    public function updated(Measurement $measurement): void
    {
        //
    }

    /**
     * Handle the Measurement "deleted" event.
     */
    public function deleted(Measurement $measurement): void
    {
        //
    }

    /**
     * Handle the Measurement "restored" event.
     */
    public function restored(Measurement $measurement): void
    {
        //
    }

    /**
     * Handle the Measurement "force deleted" event.
     */
    public function forceDeleted(Measurement $measurement): void
    {
        //
    }
}
