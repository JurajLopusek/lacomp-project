<?php

namespace App\Filament\Pages;

use App\Enums\ConsumptionRangeEnum;
use App\Filament\Custom\Inputs\DeviceSelect;
use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Traits\SlugPageTrait;
use App\Filament\Widgets\Calculations\CalculationElectricityChartWidget;
use App\Filament\Widgets\Calculations\CalculationElectricityPanelChartWidget;
use App\Filament\Widgets\Calculations\CalculationGasChartWidget;
use App\Filament\Widgets\Calculations\CalculationOutsideTemperatureChartWidget;
use App\Filament\Widgets\Calculations\CalculationWaterChartWidget;
use App\Models\Device;
use Exception;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\Page;
use Livewire\Features\SupportEvents\Event;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class ConsumptionPage extends Page
{
    use SlugPageTrait;
    use HasFiltersForm;

    protected static ?string $navigationIcon = 'phosphor-plug';
    protected static string $view = 'filament.pages.consumption-page';
    protected static ?string $title = 'Spotreba';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::DEVICE->value;

    /**
     * @throws Exception
     */
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
                        DateRangePicker::make('dates')
                            ->suffixActions([
                                Action::make('resetDate')
                                    ->tooltip('Zmazať dátum')
                                    ->label('')
                                    ->icon('heroicon-o-x-mark')
                                    ->action(fn (Set $set): mixed => $set('dates', '')),
                            ])
                            ->label('Obdobie'),
                        Select::make('groupBy')
                            ->label('Zjednotiť podľa')
                            ->placeholder('Bez zjednotenia')
                            ->options(ConsumptionRangeEnum::filamentOptions('value'))
                            ->default(ConsumptionRangeEnum::DAY->value),
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
