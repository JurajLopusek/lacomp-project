<?php

namespace App\Filament\Widgets;

use App\Enums\DateFormatEnum;
use App\Filament\Custom\Inputs\DeviceSelect;
use App\Models\Calculation;
use Carbon\Carbon;
use DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class CalculationChartWidget extends ApexChartWidget
{
    protected static ?string $chartId = 'calculationChartWidget';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'CalculationChartWidget';

    protected function getFormSchema(): array
    {
        return [
            DeviceSelect::factory(),
        ];
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $deviceId = $this->filterFormData['device_id'];
        $calculation = Calculation::where('device_id', $deviceId)->selectRaw('DATE(time) as date, SUM(electricity) as total_electricity, SUM(water) as total_water')
            ->groupBy(DB::raw('DATE(time)'))
            ->get();

        return [
            'chart' => [
                'type' => 'line',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Elektrika',
                    'data' => $calculation->pluck('total_electricity')->toArray(),
                ],
                [
                    'name' => 'Voda',
                    'data' => $calculation->pluck('total_water')->toArray(),
                ],
            ],
            'xaxis' => [
                'categories' => $calculation->pluck('date')->map(fn ($date) => Carbon::createFromDate($date)->format(DateFormatEnum::DMY->value))->toArray(),
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => [
                '#f59e0b',
                '#0000ff',
            ],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }
}
