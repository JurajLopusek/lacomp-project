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
        $device = Device::findOrFail(21);  // TODO MK: fix
        $measurements = $device->measurements->sortBy('time')->take(-10);

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
            'labels' => array_map(static fn ($key): string => Carbon::parse($key)->format(DateFormatEnum::HI->value), array_keys($water)),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
