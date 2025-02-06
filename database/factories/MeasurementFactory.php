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
            'device_id' => Device::factory()->fullData()->create()->id,

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
            /** @var Measurement $measurements */
            $measurements = Measurement::where('device_id', $measurement->device_id)->get();

            return [
                'electricity' => $measurements->max('electricity') + $this->faker->numberBetween(1, 100),
                'electricity_panel' => $measurements->max('electricity_panel') + $this->faker->numberBetween(1, 100),
                'gas' => $measurements->max('gas') + $this->faker->numberBetween(1, 100),
                'water' => $measurements->max('water') + $this->faker->numberBetween(1, 100),
                'outside_temperature' => $measurements->max('outside_temperature') + $this->faker->numberBetween(1, 100),
                'time' => Carbon::parse($measurements->max('time'))->addMinutes(10),

                'updater_id' => $this->faker->randomElement([User::inRandomOrder()->first()?->id]),
            ];
        });
    }
}
