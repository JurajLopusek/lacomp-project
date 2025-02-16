<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Device>
 */
class DeviceFactory extends Factory
{
    protected $model = Device::class;

    public function definition(): array
    {
        return [
            'serial_number' => $this->faker->unique()->regexify('[A-Z0-9]{7}'),
            'active' => 1,
        ];
    }

    public function fullData(bool $optional = false): self
    {
        return $this->state(function (array $attributes) use ($optional) {
            $faker = $optional ? $this->faker->optional() : $this->faker;

            return [
                'name' => $faker->name,
                'location' => $faker->address,
                'active' => $this->faker->boolean,

                'updater_id' => $faker->randomElement([User::inRandomOrder()->first()?->id]),
            ];
        });
    }
}
