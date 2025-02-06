<?php

namespace App\Models;

use App\Filament\Interfaces\FilamentLabelInterface;
use Database\Factories\DeviceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperDevice
 */
class Device extends GeneralModel implements FilamentLabelInterface
{
    /** @use HasFactory<DeviceFactory> */
    use HasFactory;

    protected $table = 'devices';
    protected $fillable = [
        'serial_number',
        'name',
        'location',
        'active',

        'created_at',
        'updated_at',

        'creator_id',
        'updater_id',
    ];
    protected $casts = [
        'serial_number' => 'string',
        'name' => 'string',
        'location' => 'string',
        'active' => 'boolean',

        'creator_id' => 'integer',
        'updater_id' => 'integer',
    ];

    public function getFilamentLabelAttribute(): string
    {
        return "#{$this->id} {$this->name} | {$this->serial_number}";
    }

    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class);
    }
}
