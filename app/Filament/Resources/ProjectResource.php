<?php

namespace App\Filament\Resources;

use App\Filament\Custom\Columns\IdColumnEnhanced;
use App\Filament\Custom\Columns\TextColumnEnhanced;
use App\Filament\Custom\Resource\ResourceEnhanced;
use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Interfaces\ResourceEloquentQueryInterface;
use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Traits\CommonColumnsTrait;
use App\Models\Project;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProjectResource extends ResourceEnhanced implements ResourceEloquentQueryInterface
{
    use CommonColumnsTrait;

    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'phosphor-images';
    protected static ?string $label = 'Realizácia';
    protected static ?string $pluralLabel = 'Realizácie';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::WEB->value;
    protected static ?string $recordRouteKeyName = 'projects.id';

    /** Suggested tags – same names as the services on the website. */
    public const TAG_SUGGESTIONS = ['Fotovoltika', 'Batériové úložisko', 'Kamerový systém', 'Alarmový systém', 'Revízia', 'Rekuperácia', 'Elektroinštalácia'];

    /**
     * Default tags + every tag already used in some project.
     *
     * @return array<string, string>
     */
    public static function tagOptions(): array
    {
        $tags = collect(self::TAG_SUGGESTIONS)
            ->merge(Project::query()->pluck('tags')->flatten())
            ->filter()
            ->unique()
            ->sort(SORT_LOCALE_STRING)
            ->values();

        return $tags->combine($tags)->all();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()
                ->columns()
                ->schema([
                    TextInput::make('title')
                        ->rules(['required', 'max:255'])
                        ->markAsRequired()
                        ->columnSpanFull()
                        ->label('Názov')
                        ->placeholder('Fotovoltika 10 kWp – rodinný dom'),
                    TextInput::make('location')
                        ->maxLength(255)
                        ->label('Lokalita')
                        ->placeholder('Spišské Bystré'),
                    TextInput::make('year')
                        ->numeric()
                        ->minValue(1990)
                        ->maxValue(2100)
                        ->default((int) date('Y'))
                        ->label('Rok'),
                    Select::make('tags')
                        ->multiple()
                        ->searchable()
                        ->options(fn () => self::tagOptions())
                        // labels = values; also covers a tag that was just created and is not saved in any project yet
                        ->getOptionLabelsUsing(fn (array $values) => array_combine($values, $values))
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('Nový štítok')
                                ->required()
                                ->maxLength(50),
                        ])
                        ->createOptionUsing(fn (array $data) => trim($data['name']))
                        ->createOptionModalHeading('Nový štítok')
                        ->columnSpanFull()
                        ->label('Štítky'),
                    Textarea::make('description')
                        ->rows(4)
                        ->maxLength(2000)
                        ->columnSpanFull()
                        ->label('Popis'),
                    FileUpload::make('images')
                        ->label('Fotky')
                        ->helperText('Prvá fotka je titulná. Poradie zmeníte potiahnutím. Fotky z mobilu sa pri nahraní samé otočia správne a zmenšia.')
                        ->disk('public')
                        ->directory('projects')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->appendFiles()
                        ->panelLayout('grid')
                        ->maxFiles(30)
                        ->maxSize(20 * 1024)
                        // resized in the browser before upload: fixes phone EXIF rotation and keeps files small
                        ->imageResizeMode('contain')
                        ->imageResizeTargetWidth('2000')
                        ->imageResizeTargetHeight('2000')
                        ->imageResizeUpscale(false)
                        ->columnSpanFull(),
                    Toggle::make('is_published')
                        ->inline(false)
                        ->default(true)
                        ->label('Zverejnené na webe'),
                    TextInput::make('sort')
                        ->numeric()
                        ->default(0)
                        ->helperText('Nižšie číslo = vyššie na stránke.')
                        ->label('Poradie'),
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
                Tables\Columns\ImageColumn::make('images')
                    ->disk('public')
                    ->limit(1)
                    ->square()
                    ->label('Fotka'),
                TextColumnEnhanced::make('title')
                    ->label('Názov'),
                TextColumnEnhanced::make('location')
                    ->label('Lokalita'),
                TextColumnEnhanced::make('year')
                    ->label('Rok'),
                Tables\Columns\TextColumn::make('tags')
                    ->badge()
                    ->label('Štítky'),
                Tables\Columns\ToggleColumn::make('is_published')
                    ->label('Zverejnené'),
                TextColumnEnhanced::make('sort')
                    ->label('Poradie'),
            ])->defaultSort(self::$recordRouteKeyName, 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Zverejnené'),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);

        return parent::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProjects::route('/'),
        ];
    }

    /**
     * @return Builder<Project>
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        return self::getResourceEloquentQuery($query);
    }

    /**
     * @param Builder<Project> $query
     * @return Builder<Project>
     */
    public static function getResourceEloquentQuery(Builder $query): Builder
    {
        return $query;
    }
}
