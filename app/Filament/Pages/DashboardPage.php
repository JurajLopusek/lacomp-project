<?php

namespace App\Filament\Pages;

use App\Filament\Traits\SlugPageTrait;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\Page;
use Filament\Widgets;

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
        return
            [
                //                DailyMeasurementChartWidget::class,  // TODO JL fix
                //                DailyDifferenceElecPanelChartWidget::class,  // TODO JL fix
            ];
    }
}
