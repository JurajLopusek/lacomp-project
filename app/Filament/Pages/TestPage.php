<?php

namespace App\Filament\Pages;

use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Traits\SlugPageTrait;
use Filament\Pages\Page;
use Illuminate\Support\Facades\App;
use JetBrains\PhpStorm\NoReturn;

class TestPage extends Page
{
    use SlugPageTrait;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static string $view = 'filament.pages.test-page';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::DEV->value;

    public static function canAccess(): bool
    {
        return App::environment() === 'local';
    }

    #[NoReturn]
    public function __construct()
    {
        die;
    }
}
