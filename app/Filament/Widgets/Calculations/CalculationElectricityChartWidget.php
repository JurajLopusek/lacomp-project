<?php

namespace App\Filament\Widgets\Calculations;

class CalculationElectricityChartWidget extends CalculationChartWidget
{
    protected static ?string $chartId = 'calculationElectricityChartWidget';
    protected ?string $column = 'electricity';
    protected ?string $query = 'ROUND(SUM(electricity), 0) as total_electricity';
    protected ?string $label = 'Elektrika';
    protected ?string $hexColor = '#90ee90';
}
