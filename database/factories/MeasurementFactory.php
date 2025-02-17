<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\Measurement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Measurement>
 */
class MeasurementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'electricity' => 0,
            'electricity_panel' => 0,
            'gas' => 0,
            'water' => 0,
            'outside_temperature' => 0,
            'time' => now(),

            'creator_id' => config('masterConfig.master_user_id'),
        ];
    }

    public function setDevice(Device $device): self
    {
        return $this->state(function (array $attributes) use ($device) {
            return [
                'device_id' => $device->id,
            ];
        });
    }

    public function setMeasurements(Measurement $measurement): self
    {
        return $this->state(function (array $attributes) use ($measurement) {
            return [
                'electricity' => $measurement->electricity + $this->faker->numberBetween(1, 20),
                'electricity_panel' => $measurement->electricity_panel + $this->faker->numberBetween(1, 5),
                'gas' => $measurement->gas + $this->faker->numberBetween(1, 50),
                'water' => $measurement->water + $this->faker->numberBetween(1, 100),
                'outside_temperature' => $measurement->outside_temperature + $this->faker->randomFloat(2, -5, 5),
                'time' => Carbon::parse($measurement->time)->addMinutes(10),

                'updater_id' => $this->faker->randomElement([User::inRandomOrder()->first()?->id]),
            ];
        });
    }
}
