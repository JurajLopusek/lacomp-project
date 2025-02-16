<?php

namespace App\Filament\Pages;

use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Traits\SlugPageTrait;
use Filament\Pages\Page;

class ConsumptionPage extends Page
{
    use SlugPageTrait;

    protected static ?string $navigationIcon = 'phosphor-plug';
    protected static string $view = 'filament.pages.consumption-page';
    protected static ?string $title = 'Spotreba';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::DEVICE->value;
}
