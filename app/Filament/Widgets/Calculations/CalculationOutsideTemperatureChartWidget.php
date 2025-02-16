<?php

namespace App\Filament\Widgets\Calculations;

class CalculationOutsideTemperatureChartWidget extends CalculationChartWidget
{
    protected static ?string $chartId = 'calculationOutsideTemperatureChartWidget';
    protected ?string $column = 'outside_temperature';
    protected ?string $query = 'AVG(outside_temperature) as total_outside_temperature';
    protected ?string $label = 'Teplota';
    protected ?string $hexColor = '#ff0000';
}
