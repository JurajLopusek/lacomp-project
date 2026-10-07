<?php

namespace App\Filament\Resources;

use App\Filament\Custom\Columns\IdColumnEnhanced;
use App\Filament\Custom\Columns\TextColumnEnhanced;
use App\Filament\Custom\Resource\ResourceEnhanced;
use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Interfaces\ResourceEloquentQueryInterface;
use App\Filament\Resources\PageGalleryResource\Pages;
use App\Filament\Traits\CommonColumnsTrait;
use App\Models\PageGallery;
use Closure;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Navigation\NavigationItem;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PageGalleryResource extends ResourceEnhanced implements ResourceEloquentQueryInterface
{
    use CommonColumnsTrait;

    protected static ?string $model = PageGallery::class;
    protected static ?string $navigationIcon = 'phosphor-image-square';
    protected static ?string $label = 'Galéria stránky';
    protected static ?string $pluralLabel = 'Galérie stránok';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::WEB->value;
    // edit URL uses the page key: /admin/page-galleries/fotovoltika/edit
    protected static ?string $recordRouteKeyName = 'page_galleries.page';

    /** Menu icon of every page gallery, keys from PageGallery::PAGES. */
    public const NAV_ICONS = [
        'fotovoltika' => 'phosphor-solar-panel',
        'kamery' => 'phosphor-security-camera',
        'alarmy' => 'phosphor-siren',
        'revizie' => 'phosphor-clipboard-text',
        'rekuperacie' => 'phosphor-wind',
    ];

    /**
     * One menu item per page (like "Realizácie"), each opening the edit form of its gallery.
     *
     * @return array<NavigationItem>
     */
    public static function getNavigationItems(): array
    {
        return collect(PageGallery::PAGES)
            ->map(fn (string $label, string $page) => NavigationItem::make($label)
                ->group(static::getNavigationGroup())
                ->icon(self::NAV_ICONS[$page] ?? static::getNavigationIcon())
                ->url(static::getUrl('edit', ['record' => $page]))
                ->isActiveWhen(fn () => request()->routeIs(static::getRouteBaseName() . '.edit')
                    && request()->route('record') === $page))
            ->values()
            ->all();
    }

    /**
     * Hero photo must be landscape (at least 4:3) and at least 1600 px wide.
     */
    public static function heroImageError(UploadedFile $file): ?string
    {
        [$width, $height] = @getimagesize($file->getRealPath()) ?: [0, 0];

        if ($width * 3 < $height * 4) {
            return "Fotka musí byť na šírku (aspoň 4:3), táto má {$width} × {$height} px.";
        }
        if ($width < 1600) {
            return "Fotka je príliš malá ({$width} × {$height} px), musí mať na šírku aspoň 1600 px.";
        }

        return null;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()
                ->schema([
                    Select::make('page')
                        ->options(PageGallery::PAGES)
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->disabledOn('edit')
                        ->label('Stránka'),
                    FileUpload::make('hero_image')
                        ->label('Hlavná fotka')
                        ->helperText('Veľká fotka v hornej časti stránky (pod nadpisom). Musí byť na šírku (aspoň 4:3), široká aspoň 1600 px.')
                        ->disk('public')
                        ->directory('pages')
                        ->image()
                        // hero is wide, so a portrait or small photo would be badly cropped / blurry
                        ->rules([
                            fn (): Closure => static function (string $attribute, mixed $value, Closure $fail): void {
                                if ($error = self::heroImageError($value)) {
                                    $fail($error);
                                }
                            },
                        ])
                        // show the error right after upload; while it is there the Save button is disabled (EditPageGallery)
                        ->afterStateUpdated(static function (FileUpload $component, Component $livewire, mixed $state): void {
                            $livewire->resetErrorBag($component->getStatePath());
                            foreach (array_filter(Arr::wrap($state), fn ($file) => $file instanceof TemporaryUploadedFile) as $file) {
                                if ($error = self::heroImageError($file)) {
                                    $livewire->addError($component->getStatePath(), $error);

                                    return;
                                }
                            }
                        })
                        ->maxSize(20 * 1024)
                        // resized in the browser before upload: fixes phone EXIF rotation and keeps files small
                        ->imageResizeMode('contain')
                        ->imageResizeTargetWidth('2400')
                        ->imageResizeTargetHeight('2400')
                        ->imageResizeUpscale(false),
                    FileUpload::make('images')
                        ->label('Galéria')
                        ->helperText('Poradie zmeníte potiahnutím. Fotky z mobilu sa pri nahraní samé otočia správne a zmenšia.')
                        ->disk('public')
                        ->directory('pages')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->appendFiles()
                        ->panelLayout('grid')
                        ->maxFiles(50)
                        ->maxSize(20 * 1024)
                        ->imageResizeMode('contain')
                        ->imageResizeTargetWidth('2000')
                        ->imageResizeTargetHeight('2000')
                        ->imageResizeUpscale(false),
                ]),
        ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        $table
            ->columns([
                IdColumnEnhanced::factory(),
                Tables\Columns\ImageColumn::make('hero_image')
                    ->disk('public')
                    ->square()
                    ->label('Hlavná fotka'),
                TextColumnEnhanced::make('page')
                    ->formatStateUsing(fn (string $state) => PageGallery::PAGES[$state] ?? $state)
                    ->label('Stránka'),
                Tables\Columns\ImageColumn::make('images')
                    ->disk('public')
                    ->circular()
                    ->stacked()
                    ->limit(5)
                    ->limitedRemainingText()
                    ->label('Galéria'),
            ])->defaultSort('page_galleries.id', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);

        return parent::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePageGalleries::route('/'),
            'edit' => Pages\EditPageGallery::route('/{record}/edit'),
        ];
    }

    /**
     * @return Builder<PageGallery>
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        return self::getResourceEloquentQuery($query);
    }

    /**
     * @param Builder<PageGallery> $query
     * @return Builder<PageGallery>
     */
    public static function getResourceEloquentQuery(Builder $query): Builder
    {
        return $query;
    }
}
