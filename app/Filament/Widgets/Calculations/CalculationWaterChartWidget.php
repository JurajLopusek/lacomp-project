<?php

namespace App\Filament\Widgets\Calculations;

class CalculationWaterChartWidget extends CalculationChartWidget
{
    protected static ?string $chartId = 'calculationWaterChartWidget';
    protected ?string $column = 'water';
    protected ?string $query = 'ROUND(SUM(water), 0) as total_water';
    protected ?string $label = 'Voda';
    protected ?string $hexColor = '#1e90ff';
}
