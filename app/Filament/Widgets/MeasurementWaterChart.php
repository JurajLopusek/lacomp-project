<?php

namespace App\Filament\Widgets;

use App\Enums\DateFormatEnum;
use App\Models\Device;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class MeasurementWaterChart extends ChartWidget
{
    protected static ?string $heading = 'Voda';

    protected function getData(): array
    {
        $device = Device::findOrFail(21);
        $measurements = $device->calculations->sortBy('time')->take(-20);
        $water = $measurements->pluck('water', 'time')->toArray();
        $electricity = $measurements->pluck('electricity', 'time')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Voda',
                    'color' => '#00A3F5',
                    'backgroundColor' => '#00A3F5',
                    'borderColor' => '#00A3F5',
                    'data' => array_values($water),
                ],

                [
                    'label' => 'Elektrika',
                    'color' => 'green',
                    'backgroundColor' => 'green',
                    'borderColor' => 'green',
                    'data' => array_values($electricity),
                ],
            ],
            'labels' => array_map(static fn ($key) => Carbon::parse($key)->format(DateFormatEnum::HI->value), array_keys($water)),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
