<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $device_id
 * @property int|null $electricity
 * @property int|null $electricity_panel
 * @property int|null $gas
 * @property int|null $water
 * @property int|null $outside_temperature
 * @property \Illuminate\Support\Carbon|null $time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $creator_id
 * @property int|null $updater_id
 * @property-read \App\Models\Measurement|null $calculation
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\Device $device
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\User|null $updater
 * @method static \Database\Factories\CalculationFactory factory($count = null, $state = [])
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation newModelQuery()
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation newQuery()
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation query()
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereCreatedAt($value)
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereCreatorId($value)
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereDeviceId($value)
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereElectricity($value)
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereElectricityPanel($value)
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereGas($value)
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereId($value)
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereOutsideTemperature($value)
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereTime($value)
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereUpdatedAt($value)
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereUpdaterId($value)
 * @method static \App\QueryBuilders\CalculationQueryBuilder<static>|Calculation whereWater($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCalculation {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $serial_number
 * @property string|null $name
 * @property string|null $location
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $creator_id
 * @property int|null $updater_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Calculation> $calculations
 * @property-read int|null $calculations_count
 * @property-read \App\Models\User $creator
 * @property-read string $filament_label
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Measurement> $measurements
 * @property-read int|null $measurements_count
 * @property-read \App\Models\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\DeviceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device whereUpdaterId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperDevice {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralModel query()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperGeneralModel {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $device_id
 * @property int|null $electricity
 * @property int|null $electricity_panel
 * @property int|null $gas
 * @property int|null $water
 * @property float|null $outside_temperature
 * @property \Illuminate\Support\Carbon $time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $creator_id
 * @property int|null $updater_id
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\Device $device
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\User|null $updater
 * @method static \Database\Factories\MeasurementFactory factory($count = null, $state = [])
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement newModelQuery()
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement newQuery()
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement query()
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereCreatedAt($value)
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereCreatorId($value)
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereDeviceId($value)
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereElectricity($value)
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereElectricityPanel($value)
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereGas($value)
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereId($value)
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereOutsideTemperature($value)
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereTime($value)
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereUpdatedAt($value)
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereUpdaterId($value)
 * @method static \App\QueryBuilders\MeasurementQueryBuilder<static>|Measurement whereWater($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperMeasurement {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $creator_id
 * @property int|null $updater_id
 * @property-read User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Device> $devices
 * @property-read int|null $devices_count
 * @property-read string $filament_label
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read User|null $updater
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User newModelQuery()
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User permission($permissions, $without = false)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User query()
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User role($roles, $guard = null, $without = false)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User whereCreatedAt($value)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User whereCreatorId($value)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User whereDeletedAt($value)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User whereEmail($value)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User whereEmailVerifiedAt($value)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User whereId($value)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User whereName($value)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User wherePassword($value)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User whereRememberToken($value)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User whereUpdatedAt($value)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User whereUpdaterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed()
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User withoutPermission($permissions)
 * @method static \App\QueryBuilders\UserQueryBuilder<static>|User withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

