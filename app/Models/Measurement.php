<?php

namespace App\Models;

use Database\Factories\MeasurementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperMeasurement
 */
class Measurement extends GeneralModel
{
    /** @use HasFactory<MeasurementFactory> */
    use HasFactory;

    protected $table = 'measurements';
    protected $fillable = [
        'device_id',
        'electricity',
        'electricity_panel',
        'gas',
        'water',
        'outside_temperature',
        'time',

        'created_at',
        'updated_at',

        'creator_id',
        'updater_id',
    ];
    protected $casts = [
        'device_id' => 'integer',
        'electricity' => 'integer',
        'electricity_panel' => 'integer',
        'gas' => 'integer',
        'water' => 'integer',
        'outside_temperature' => 'integer',
        'time' => 'datetime',

        'created_at' => 'datetime',
        'updated_at' => 'datetime',

        'creator_id' => 'integer',
        'updater_id' => 'integer',
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
