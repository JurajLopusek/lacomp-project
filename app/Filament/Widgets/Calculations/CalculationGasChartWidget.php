<?php

namespace App\Filament\Widgets\Calculations;

class CalculationGasChartWidget extends CalculationChartWidget
{
    protected static ?string $chartId = 'calculationGasChartWidget';
    protected ?string $column = 'gas';
    protected ?string $query = 'ROUND(SUM(gas), 0) as total_gas';
    protected ?string $label = 'Plyn';
    protected ?string $hexColor = '#964B00';
}
