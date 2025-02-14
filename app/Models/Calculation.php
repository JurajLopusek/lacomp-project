<?php

namespace App\Models;

use App\Observers\MeasurementObserver;
use App\QueryBuilders\CalculationQueryBuilder;
use App\QueryBuilders\MeasurementQueryBuilder;
use Database\Factories\CalculationFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperCalculation
 */
#[ObservedBy([MeasurementObserver::class])]
class Calculation extends GeneralModel
{
    /** @use HasFactory<CalculationFactory> */
    use HasFactory;

    protected $table = 'calculations';
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
     * @return CalculationQueryBuilder
     */
    public function newEloquentBuilder($query): CalculationQueryBuilder
    {
        return new CalculationQueryBuilder($query);
    }

    /**
     * @return BelongsTo<Measurement, $this>
     */
    public function calculation(): BelongsTo
    {
        return $this->belongsTo(Measurement::class);
    }

    /**
     * @return BelongsTo<Device, $this>
     */
//    public function device(): BelongsTo
//    {
//        return $this->belongsTo(Device::class);
//    }
    public function device(): BelongsTo
    {
        return $this->belongsTo(Measurement::class);
    }
}
