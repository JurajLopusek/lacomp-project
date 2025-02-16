<?php

namespace App\Filament\Pages;

use App\Filament\Custom\Inputs\DeviceSelect;
use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Traits\SlugPageTrait;
use App\Filament\Widgets\Calculations\CalculationElectricityChartWidget;
use App\Filament\Widgets\Calculations\CalculationElectricityPanelChartWidget;
use App\Filament\Widgets\Calculations\CalculationGasChartWidget;
use App\Filament\Widgets\Calculations\CalculationOutsideTemperatureChartWidget;
use App\Filament\Widgets\Calculations\CalculationWaterChartWidget;
use App\Models\Device;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\Page;
use Livewire\Features\SupportEvents\Event;

class ConsumptionPage extends Page
{
    use SlugPageTrait;
    use HasFiltersForm;

    protected static ?string $navigationIcon = 'phosphor-plug';
    protected static string $view = 'filament.pages.consumption-page';
    protected static ?string $title = 'Spotreba';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::DEVICE->value;

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
     * @return string[]
     */
    public function footerWidgets(): array
    {
        return [
            CalculationWaterChartWidget::class,
            CalculationOutsideTemperatureChartWidget::class,
            CalculationElectricityPanelChartWidget::class,
            CalculationElectricityChartWidget::class,
            CalculationGasChartWidget::class,
        ];
    }
}
