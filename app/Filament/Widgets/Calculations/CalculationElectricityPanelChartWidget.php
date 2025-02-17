<?php

namespace App\Filament\Widgets\Calculations;

class CalculationElectricityPanelChartWidget extends CalculationChartWidget
{
    protected static ?string $chartId = 'calculationElectricityPanelChartWidget';
    protected ?string $column = 'electricity_panel';
    protected ?string $query = 'ROUND(SUM(electricity_panel), 0) as total_electricity_panel';
    protected ?string $label = 'Elektrický panel';
    protected ?string $hexColor = '#8fbc8f';
}
