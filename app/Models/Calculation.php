<?php

namespace App\Models;

use App\QueryBuilders\CalculationQueryBuilder;
use Database\Factories\CalculationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperCalculation
 */
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
    ];
    protected $casts = [
        'device_id' => 'integer',
        'electricity' => 'integer',
        'electricity_panel' => 'integer',
        'gas' => 'integer',
        'water' => 'integer',
        'outside_temperature' => 'integer',
        'time' => 'datetime',
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
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
