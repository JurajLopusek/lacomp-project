<?php

namespace App\Filament\Pages;

use App\Enums\ConsumptionRangeEnum;
use App\Enums\GraphTypeEnum;
use App\Filament\Custom\Inputs\DeviceSelect;
use App\Filament\Traits\SlugPageTrait;
use App\Filament\Widgets\Calculations\CalculationElectricityChartWidget;
use App\Filament\Widgets\Calculations\CalculationElectricityPanelChartWidget;
use App\Filament\Widgets\Calculations\DailyDifferenceElecPanelChartWidget;
use App\Filament\Widgets\Calculations\DailyMeasurementChartWidget;
use App\Models\Calculation;
use App\Models\Device;
use Carbon\Carbon;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\Page;
use Filament\Widgets;
use Livewire\Features\SupportEvents\Event;

class DashboardPage extends Page
{
    use SlugPageTrait;
    use HasFiltersForm;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard-page';
    protected static ?string $title = 'Rýchle informácie';

    protected function getColumns(): int|array
    {
        return 2;
    }
    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->live()
                    ->columns(4)
                    ->schema([
                        DeviceSelect::factory()
                            ->afterStateUpdated(fn (): Event => $this->dispatch('updateOptions'))
                            ->default(Device::orderBy('created_at', 'desc')->first()?->id)
                            ->options(Device::limit(25)->orderByDesc('id')->get()->pluck('filament_label', 'id')),
                    ]),
            ]);
    }
    /**
     * @return array
     */
    public function headerWidgets(): array
    {
        return
            [
                Widgets\AccountWidget::class,
            ];
    }

    public function footerWidgets(): array
    {

        $deviceId = $this->filters['device_id'] ?? null;
        $widgets = [];
        if ($this->hasData('electricity', $deviceId) || $this->hasData('electricity_panel', $deviceId) || $this->hasData('water', $deviceId) || $this->hasData('gas', $deviceId)) {
            $widgets[] = DailyMeasurementChartWidget::class;

        }

        if ($this->hasData('electricity_panel', $deviceId) || $this->hasData('electricity', $deviceId)) {
            $widgets[] = DailyDifferenceElecPanelChartWidget::class;
        }

        return $widgets;


    }
    private function hasData(string $column, int $deviceId): bool
    {
        return Calculation::where('device_id', $deviceId)
            ->whereDate('time', Carbon::today())
            ->where($column, '>', 0)
            ->exists();
    }
}
