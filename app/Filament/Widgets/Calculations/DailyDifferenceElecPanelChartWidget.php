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

class DailyDifferenceElecPanelChartWidget extends ApexChartWidget
{
    protected static ?string $chartId = 'DailyDifferenceElecPanelChart';
    protected ?string $label = 'Dnešny rodiel';
    protected ?string $hexColor = '#ff0000';

    use  InteractsWithPageFilters;
    protected ?string $queryElectricity = 'ROUND(SUM(electricity), 0) as daily_electricity';
    protected ?string $queryElectricityPanel = 'ROUND(SUM(electricity_panel), 0) as daily_electricity_panel';



    protected static ?string $heading = 'Diff';

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
        $today = Carbon::today()->toDateString();
        $enum = ConsumptionRangeEnum::HOUR;

        $calculation = Calculation::where('device_id', $deviceId)
            ->whereDate('time', $today)
            ->selectRaw("{$enum->selectRaw()} as date, {$this->queryElectricity}")

            ->selectRaw("{$enum->selectRaw()} as date, {$this->queryElectricityPanel}");

        $calculation = $calculation
            ->orderBy('date')
            ->groupBy(DB::raw('date'))
            ->get();
        $totalElectricity = $calculation->sum('daily_electricity');
        $totalElectricityPanel = $calculation->sum('daily_electricity_panel');

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 400,
            ],
            'labels'=> ['Elektrika', 'Elektrika z panelov'],
            'series'=> [$totalElectricity, $totalElectricityPanel],
            'stroke' => [
                'width' => 2,
                'colors' => ['#fff'],
            ],
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
