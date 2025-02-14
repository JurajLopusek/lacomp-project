<?php

namespace App\Filament\Widgets;

use App\Enums\DateFormatEnum;
use App\Models\Device;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Widget;

class MeasurementStats extends Widget
{
    protected static ?string $heading = 'Spotreba elektriky';

    public ?string $selectedPeriod = 'day'; // Predvolený filter


    protected function getData(): array
    {
        $device = Device::findOrFail(1);
        $measurementsWater = $device->calculations->sortBy('time');

        if ($this->selectedPeriod === 'day') {
            $measurementsWater = $measurementsWater->where('time', '>=', Carbon::now()->subDay());
        } elseif ($this->selectedPeriod === 'week') {
            $measurementsWater = $measurementsWater->where('time', '>=', Carbon::now()->subWeek());
        } elseif ($this->selectedPeriod === 'month') {
            $measurementsWater = $measurementsWater->where('time', '>=', Carbon::now()->subMonth());
        }
        $electricity = $measurementsWater->pluck('electricity', 'time')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Elektrika',
                    'color' => '#00A3F5',
                    'backgroundColor' => '#00A3F5',
                    'borderColor' => '#00A3F5',
                    'data' => array_values($electricity),
                ],
            ],
            'labels' => array_map(static fn($key) => Carbon::parse($key)->format(DateFormatEnum::HI->value), array_keys($electricity)),
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
