<?php

namespace App\Filament\Widgets;

use App\Enums\DateFormatEnum;
use App\Models\Device;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Widgets\ChartWidget;

class MeasurementStats extends ChartWidget
{
    protected static ?string $heading = 'Spotreba vody';

    public ?string $selectedPeriod = 'day'; // Predvolený filter


    protected function getData(): array
    {
        $device = Device::findOrFail(1);
        $measurementsWater = $device->calculations->sortBy('time')->take;

        if ($this->selectedPeriod === 'day') {
            $measurementsWater = $measurementsWater->where('time', '>=', Carbon::now()->subDay());
        } elseif ($this->selectedPeriod === 'week') {
            $measurementsWater = $measurementsWater->where('time', '>=', Carbon::now()->subWeek());
        } elseif ($this->selectedPeriod === 'month') {
            $measurementsWater = $measurementsWater->where('time', '>=', Carbon::now()->subMonth());
        }
        $water = $measurementsWater->pluck('water', 'time')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Voda',
                    'color' => '#00A3F5',
                    'backgroundColor' => '#00A3F5',
                    'borderColor' => '#00A3F5',
                    'data' => array_values($water),
                ],
            ],
            'labels' => array_map(static fn($key) => Carbon::parse($key)->format(DateFormatEnum::HI->value), array_keys($water)),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
    protected function getFormSchema(): array
    {
        return [
            Select::make('selectedPeriod')
                ->label('Obdobie')
                ->options([
                    'day' => 'Posledných 24 hodín',
                    'week' => 'Posledných 7 dní',
                    'month' => 'Posledných 30 dní',
                ])
                ->default('day')
                ->reactive(), // Zabezpečí, že sa graf obnoví po zmene výberu
        ];
    }
}
