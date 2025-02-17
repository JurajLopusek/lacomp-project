<?php

namespace App\Providers\Filament;

use App\Enums\DateFormatEnum;
use App\Filament\Traits\FilamentNotificationTrait;
use Exception;
use Filafly\PhosphorIconReplacement;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Resources\Components\Tab;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\View\TablesRenderHook;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\View\WidgetsRenderHook;
use FilipFonal\FilamentLogManager\FilamentLogManager;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use ReflectionClass;

abstract class BaseProvider extends PanelProvider
{
    use FilamentNotificationTrait;

    public function displayRenderPanelHooks(Panel $panel): Panel
    {
        $panelHooks = new ReflectionClass(PanelsRenderHook::class);
        $tableHooks = new ReflectionClass(TablesRenderHook::class);
        $widgetHooks = new ReflectionClass(WidgetsRenderHook::class);

        $panelHooks = $panelHooks->getConstants();
        $tableHooks = $tableHooks->getConstants();
        $widgetHooks = $widgetHooks->getConstants();

        /** @var string $hook */
        foreach ($panelHooks as $hook) {
            $panel->renderHook($hook, function () use ($hook) {
                return Blade::render('<div style="border: solid red 1px; padding: 2px;">{{ $name }}</div>', [
                    'name' => Str::of($hook)->remove('tables::'),
                ]);
            });
        }

        /** @var string $hook */
        foreach ($tableHooks as $hook) {
            $panel->renderHook($hook, function () use ($hook) {
                return Blade::render('<div style="border: solid red 1px; padding: 2px;">{{ $name }}</div>', [
                    'name' => Str::of($hook)->remove('tables::'),
                ]);
            });
        }

        /** @var string $hook */
        foreach ($widgetHooks as $hook) {
            $panel->renderHook($hook, function () use ($hook) {
                return Blade::render('<div style="border: solid red 1px; padding: 2px;">{{ $name }}</div>', [
                    'name' => Str::of($hook)->remove('tables::'),
                ]);
            });
        }

        return $panel;
    }

    public function panel(Panel $panel): Panel
    {
        $panel
            ->font('sans-serif')
//            ->favicon('/favicon.png')
//            ->brandLogo('/images/fingo-logo.png')
//            ->darkModeBrandLogo('/images/fingo-logo.png')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->breadcrumbs(false)
            ->unsavedChangesAlerts()
            ->databaseTransactions()
            ->plugins([
                FilamentApexChartsPlugin::make(),
                PhosphorIconReplacement::make()->light(),
                FilamentLogManager::make(),
            ])
            ->maxContentWidth(MaxWidth::Full)
            ->bootUsing(function () {
                self::colorConfigurator();
            });

//        $this->displayRenderPanelHooks($panel);  // NOTE: this will display render hooks

        return $panel;
    }

    protected static function bootDefaultFormats(): void
    {
        Table::$defaultDateTimeDisplayFormat = DateFormatEnum::DMY_HIS->value;
        Table::$defaultDateDisplayFormat = DateFormatEnum::DMY_HIS->value;
        Table::$defaultCurrency = '€';
        Table::$defaultTimeDisplayFormat = DateFormatEnum::HMS->value;

        Infolist::$defaultDateTimeDisplayFormat = DateFormatEnum::DMY_HIS->value;
        Infolist::$defaultDateDisplayFormat = DateFormatEnum::DMY_HIS->value;
        Infolist::$defaultCurrency = '€';
        Infolist::$defaultTimeDisplayFormat = DateFormatEnum::HMS->value;
    }

    protected static function bootCommon(): void
    {
        self::bootDefaultFormats();

        DeleteAction::configureUsing(static function (DeleteAction $deleteAction): void {
            $deleteAction->icon('heroicon-o-trash')
                ->label('')
                ->iconButton()
                ->color('danger')
                ->requiresConfirmation()
                ->tooltip('Odstrániť')
                ->successNotification(fn (): \Filament\Notifications\Notification => self::getSuccessNotification())
                ->action(function ($record, DeleteAction $deleteAction): void {
                    try {
                        DB::beginTransaction();
                        $record->delete();
                        $deleteAction->success();
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                        $deleteAction->failureNotification(function () use ($e) {
                            return self::getErrorNotification(body: $e->getMessage());
                        });
                        $deleteAction->failure();
                    }
                });
        }, isImportant: true);

        ReplicateAction::configureUsing(static function (ReplicateAction $replicateAction): void {
            $replicateAction->icon('heroicon-o-square-2-stack')
                ->label('')
                ->iconButton()
                ->requiresConfirmation()
                ->modalHeading(fn (Model $record, $livewire): string => 'Duplikovať')
                ->tooltip('Duplikovať');
        }, isImportant: true);

        EditAction::configureUsing(static function (EditAction $editAction): void {
            $editAction->icon('heroicon-o-pencil-square')
                ->label('')
                ->iconButton()
                ->color('primary')
                ->tooltip('Upraviť');
        }, isImportant: true);

        ViewAction::configureUsing(static function (ViewAction $viewAction): void {
            $viewAction->icon('heroicon-o-eye')
                ->label('')
                ->iconButton()
                ->color('secondary')
                ->tooltip('Zobraziť');
        }, isImportant: true);

        CreateAction::configureUsing(static function (CreateAction $createAction): void {
            $createAction->createAnother(false);
        }, isImportant: true);

        \Filament\Actions\CreateAction::configureUsing(static function (\Filament\Actions\CreateAction $createAction): void {
            $createAction->createAnother(false);
        }, isImportant: true);

        Select::configureUsing(static function (Select $select): void {
            $select->native(false);
        }, isImportant: true);

        DateTimePicker::configureUsing(static function (DateTimePicker $dateTimePicker): void {
            $dateTimePicker->native(false)
                ->displayFormat(DateFormatEnum::DMY_HIS->value)
                ->placeholder(DateFormatEnum::DDMMYYYY_HIS_LOWER->value)
                ->date();
        }, isImportant: true);

        DatePicker::configureUsing(static function (DatePicker $datePicker): void {
            $datePicker->native(false)
                ->displayFormat(DateFormatEnum::DMY->value)
                ->placeholder(DateFormatEnum::DDMMYYYY_LOWER->value)
                ->date();
        }, isImportant: true);

        FileUpload::configureUsing(static function (FileUpload $fileUpload): void {
            $fileUpload->placeholder('Pridať súbory');
        });

        TextEntry::configureUsing(static function (TextEntry $textEntry): void {
            $textEntry->color('secondary')
                ->placeholder('-')
                ->extraAttributes([
                    'style' => 'overflow-wrap: break-word;',
                ]);
        }, isImportant: true);

        TextInput::configureUsing(static function (TextInput $textInput): void {
            $textInput->placeholder(function () use ($textInput): string {
                /** @var string $text */
                $text = $textInput->getLabel();

                return 'Zadajte ' . Str::lower($text);
            });
        });

        TrashedFilter::configureUsing(static function (TrashedFilter $trashedFilter): void {
            $trashedFilter->native(false);
        }, isImportant: true);

        DateRangeFilter::configureUsing(static function (DateRangeFilter $dateRangeFilter) {
            $dateRangeFilter
                ->autoApply()
                ->icon('heroicon-o-x-mark')
                ->displayFormat(DateFormatEnum::DDMMYYYY_UPPER->value)
                ->format(DateFormatEnum::DMY->value)
                ->placeholder('Vyberte obdobie')
                ->withIndicator();
        }, isImportant: true);

        DateRangePicker::configureUsing(static function (DateRangePicker $dateRangePicker) {
            $dateRangePicker
                ->autoApply()
                ->icon('heroicon-o-x-mark')
                ->displayFormat(DateFormatEnum::DDMMYYYY_UPPER->value)
                ->format(DateFormatEnum::DMY->value)
                ->placeholder('Vyberte obdobie');
        }, isImportant: true);

        TernaryFilter::configureUsing(static function (TernaryFilter $ternaryFilter): void {
            $ternaryFilter->native(false)
                ->placeholder('Všetko');
        }, isImportant: true);

        SelectFilter::configureUsing(static function (SelectFilter $selectFilter): void {
            $selectFilter->native(false);
        }, isImportant: true);

        IconColumn::configureUsing(static function (IconColumn $iconColumn) {
            $iconColumn->alignCenter();
        }, isImportant: true);

        Tab::configureUsing(static function (Tab $tab): void {
            $tab->badgeColor('secondary');
        }, isImportant: true);

        Table::configureUsing(static function (Table $table): void {
            $table->emptyStateHeading(fn ($livewire): string => 'Nenašiel sa žiaden záznam')
                ->emptyStateDescription(null)
                ->emptyStateIcon('heroicon-o-magnifying-glass')
                ->striped();
        }, isImportant: true);

        TextColumn::configureUsing(static function (TextColumn $textColumn): void {
            $textColumn->placeholder(fn ($state) => $state ?? new HtmlString('<i>NULL</i>'));
        }, isImportant: true);
    }

    public static function colorConfigurator(): void
    {
        FilamentColor::register([
            'filamentPrimary' => Color::Blue,
            'filamentSecondary' => Color::Gray,
            'primary' => Color::Amber,
            'secondary' => Color::Gray,
            'danger' => Color::Red,
            'gray' => Color::Zinc,
            'info' => Color::Blue,
            'success' => Color::Green,
            'warning' => Color::Amber,
            'custom' => [
                50 => '254, 242, 242',
                100 => '254, 226, 226',
                200 => '254, 202, 202',
                300 => '252, 165, 165',
                400 => '248, 113, 113',
                500 => '239, 68, 68',
                600 => '220, 38, 38',
                700 => '185, 28, 28',
                800 => '153, 27, 27',
                900 => '127, 29, 29',
                950 => '69, 10, 10',
            ],
            'custom_hex' => Color::hex('#ff0000'),
            'custom_rgb' => Color::rgb('rgb(255, 0, 0)'),
        ]);
    }
}
