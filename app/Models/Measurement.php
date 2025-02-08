<?php

namespace App\Models;

use App\Observers\MeasurementObserver;
use App\QueryBuilders\MeasurementQueryBuilder;
use Database\Factories\MeasurementFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperMeasurement
 */
#[ObservedBy([MeasurementObserver::class])]
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

    /**
     * @param $query
     * @return MeasurementQueryBuilder
     */
    public function newEloquentBuilder($query): MeasurementQueryBuilder
    {
        return new MeasurementQueryBuilder($query);
    }

    /**
     * @return BelongsTo<Device, $this>
     */
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
