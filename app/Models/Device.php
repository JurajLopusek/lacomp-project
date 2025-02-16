<?php

namespace App\Models;

use App\Filament\Interfaces\FilamentLabelInterface;
use Database\Factories\DeviceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    ];
    protected $casts = [
        'serial_number' => 'string',
        'name' => 'string',
        'location' => 'string',
        'active' => 'boolean',
    ];
    protected $appends = [
        'filament_label',
    ];

    public function getFilamentLabelAttribute(): string
    {
        return "#{$this->id} {$this->name} | {$this->serial_number}";
    }

    /**
     * @return HasMany<Measurement, $this>
     */
    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class);
    }

    public function calculations(): HasMany
    {
        return $this->hasMany(Calculation::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
