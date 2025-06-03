<?php

namespace App\Filament\Widgets\Calculations;

use App\Enums\ConsumptionRangeEnum;
use App\Models\Calculation;
use App\Models\Device;
use Carbon\Carbon;
use DB;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class DailyMeasurementChartWidget extends ApexChartWidget
{
    protected static ?string $chartId = 'DailyMeasurementChartWidget';
    protected ?string $label = 'Dnešne meranie';
    protected ?string $hexColor = '#ff0000';

    use  InteractsWithPageFilters;
    protected ?string $queryElectricity = 'ROUND(SUM(electricity), 0) as daily_electricity';
    protected ?string $queryGas= 'ROUND(SUM(gas), 0) as daily_gas';
    protected ?string $queryWater = 'ROUND(SUM(water), 0) as daily_water';
    protected ?string $queryElectricityPanel = 'ROUND(SUM(electricity_panel), 0) as daily_electricity_panel';



    protected static ?string $heading = 'Chart';

    protected function getHeading(): null|string|Htmlable|View
    {
        $device = Device::find($this->filters['device_id']);

        if ($device) {
            $this->updateOptions();
        }
        return $this->label;
    }

    protected function getOptions(): array
    {
        if (!isset($this->filters['device_id'])) {
            return [];
        }

        $deviceId = $this->filters['device_id'];
        $today = Carbon::today();
        $enum = ConsumptionRangeEnum::HOUR;

        $calculation = Calculation::where('device_id', $deviceId)
            ->whereDate('time', $today)
            ->selectRaw("{$enum->selectRaw()} as date") // 'date' pridáme iba raz
            ->selectRaw("{$this->queryElectricity}")
            ->selectRaw("{$this->queryWater}")
            ->selectRaw("{$this->queryGas}")
            ->selectRaw("{$this->queryElectricityPanel}")
            ->groupBy(DB::raw('date'))
            ->orderBy('date')
            ->get();

        $totalElectricity = $calculation->sum('daily_electricity');
        $totalElectricityPanel = $calculation->sum('daily_electricity_panel');
        $totalGas = $calculation->sum('daily_gas');
        $totalWater = $calculation->sum('daily_water');

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 400,
            ],
            'labels'=> ['Voda', 'Elektrika', 'Elektrika z panelov','Plyn'],
            'series'=> [$totalWater, $totalElectricity, $totalElectricityPanel, $totalGas],
            'stroke' => [
                'width' => 2,
                'colors' => ['#fff'],

            ],
//            'colors' => ['#3498db', '#f39c12', '#27ae60', '#e74c3c'],
            'legend' => [
                'position' => 'bottom',
            ],
            'responsive' => [
                [
                    'breakpoint' => 480,  // Pre zariadenia s šírkou menšou ako 480px
                    'options' => [
                        'chart' => [
                            'width' => 200,  // Nastav šírku grafu na 200px pre malé obrazovky
                        ],
                        'legend' => [
                            'position' => 'bottom',  // Zmeň umiestnenie legendy na spodok
                        ],
                    ],
                ],
            ],
        ];
    }
}
