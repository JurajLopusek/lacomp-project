<?php

namespace App\Filament\Widgets\Calculations;

use App\Enums\ConsumptionRangeEnum;
use App\Enums\GraphType;
use App\Models\Calculation;
use App\Models\Device;
use Carbon\Carbon;
use DB;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class CalculationChartWidget extends ApexChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $pollingInterval = null;
    protected ?string $column;
    protected ?string $query;
    protected ?string $label;
    protected ?string $hexColor;

    protected function getHeading(): null|string|Htmlable|View
    {
        if (!isset($this->filters['device_id'])) {
            return $this->label;
        }

        $device = Device::find($this->filters['device_id']);

        if ($device) {
            $this->updateOptions();
        }

        return $this->label;
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
        /** @var Builder $calculation */
        $calculation = Calculation::where('device_id', $deviceId);

        if (isset($this->filters['groupBy']) && $this->filters['groupBy'] !== null && ($enum = ConsumptionRangeEnum::tryFrom($this->filters['groupBy']))) {
            $calculation->selectRaw("{$enum->selectRaw()} as date, {$this->query}");
        } else {
            $calculation->selectRaw("time as date, {$this->query}");
        }

        if (isset($this->filters['dates']) && $this->filters['dates'] !== '') {
            [$startDate, $endDate] = explode(' - ', $this->filters['dates']);

            $startDate = Carbon::createFromFormat('d.m.Y', $startDate)?->startOfDay();
            $endDate = Carbon::createFromFormat('d.m.Y', $endDate)?->endOfDay();

            $calculation->whereBetween('time', [$startDate, $endDate]);
        } else {
            $calculation->take(31);
        }

        $calculation = $calculation
            ->orderBy('date')
            ->groupBy(DB::raw('date'))
            ->get();
        $graphType = GraphType::tryFrom($this->filters['graphType']);
        return [
            'chart' => [
                'type' => $graphType ? $graphType->selectType() : 'line',
                'height' => 300,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => $this->label,
                    'data' => $calculation->pluck('total_' . $this->column)->toArray(),
                ],
            ],
            'xaxis' => [
                'categories' => $calculation->pluck('date')
                    ->map(function ($date) {
                        if (is_string($date)) {
                            $enum = ConsumptionRangeEnum::tryFrom($this->filters['groupBy']);
                            $carbonDate = Carbon::parse($date);

                            return $enum?->formatDateFromCarbon($carbonDate) ?? $carbonDate->format('d.m. H:i');
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
                'width' => 3,
            ],
        ];
    }
}
