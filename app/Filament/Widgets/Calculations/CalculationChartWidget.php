<?php

namespace App\Filament\Widgets\Calculations;

use App\Models\Calculation;
use App\Models\Device;
use Carbon\Carbon;
use DB;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class CalculationChartWidget extends ApexChartWidget
{
    use InteractsWithPageFilters;

    protected int|string|array $columnSpan = 1;
    protected static ?string $pollingInterval = null;
    protected ?string $column;
    protected ?string $query;
    protected ?string $label;
    protected ?string $hexColor;

    protected function getHeading(): null|string|Htmlable|View
    {
        if (!isset($this->filters['device_id'])) {
            return null;
        }

        $device = Device::find($this->filters['device_id']);

        if ($device) {
            $this->updateOptions();

            return $this->label;
        }

        return self::$heading;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getOptions(): array
    {
        if (!isset($this->filters['device_id'])) {
            return [];
        }

        $deviceId = $this->filters['device_id'];
        $calculation = Calculation::where('device_id', $deviceId)
            ->selectRaw('DATE(time) as date, ' . $this->query)
            ->groupBy(DB::raw('date'))
            ->get();

        return [
            'chart' => [
                'type' => 'line',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => $this->label,
                    'data' => $calculation->pluck('total_' . $this->column)->toArray(),
                ],
            ],
            'xaxis' => [
                'categories' =>  $calculation->pluck('date')
                    ->map(function ($date) {
                        if ($date instanceof Carbon) {
                            return $date->format('d.m');
                        }

                        if (is_string($date)) {
                            return Carbon::createFromFormat('Y-m-d', $date)?->format('d.m');
                        }

                        return null;
                    })
                    ->toArray(),
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
                $this->hexColor,
            ],
            'stroke' => [
                'curve' => 'smooth',
                'width' => 2,
            ],
        ];
    }
}
