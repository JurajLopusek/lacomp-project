<?php

namespace App\Models;

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
        'deviceCalc_id',
        'electricityCalc',
        'electricity_panelCalc',
        'gasCalc',
        'waterCalc',
        'outside_temperatureCalc',
        'time',

        'created_at',
        'updated_at',

    ];
    protected $casts = [
        'deviceCalc_id' => 'integer',
        'electricityCalc' => 'integer',
        'electricity_panelCalc' => 'integer',
        'gasCalc' => 'integer',
        'waterCalc' => 'integer',
        'outside_temperatureCalc' => 'integer',
        'time' => 'datetime',

        'created_at' => 'datetime',
        'updated_at' => 'datetime',

    ];

    public function calculation(): BelongsTo
    {
        return $this->belongsTo(Measurement::class);
    }
}
