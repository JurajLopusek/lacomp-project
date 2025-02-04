<?php

namespace App\Providers\Filament;

use App\Filament\Enums\FilamentPanelEnum;
use Exception;
use Filament\Pages;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\Widgets;

class AdminPanelProvider extends BaseProvider
{
    /**
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        $panel
            ->default()
            ->login()
            ->passwordReset()
            ->bootUsing(function () {
                parent::bootCommon();
            })
            ->id(FilamentPanelEnum::ADMIN->value)
            ->path(FilamentPanelEnum::ADMIN->value)
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ]);

        return parent::panel($panel);
    }
}
