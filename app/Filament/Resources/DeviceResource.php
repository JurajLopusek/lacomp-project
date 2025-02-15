<?php

namespace App\Filament\Resources;

use App\Filament\Custom\Columns\IdColumnEnhanced;
use App\Filament\Custom\Columns\TextColumnEnhanced;
use App\Filament\Custom\Inputs\UserSelect;
use App\Filament\Custom\Resource\ResourceEnhanced;
use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Interfaces\ResourceEloquentQueryInterface;
use App\Filament\Resources\DeviceResource\Pages;
use App\Filament\Traits\CommonColumnsTrait;
use App\Models\Device;
use App\Models\User;
use Exception;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DeviceResource extends ResourceEnhanced implements ResourceEloquentQueryInterface
{
    use CommonColumnsTrait;

    protected static ?string $model = Device::class;
    protected static ?string $navigationIcon = 'phosphor-usb';
    protected static ?string $label = 'Zariadenie';
    protected static ?string $pluralLabel = 'Zariadenia';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::DEVICE->value;
    protected static ?string $recordRouteKeyName = 'devices.id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()
                ->columns()
                ->schema([
                    TextInput::make('serial_number')
                        ->rules(['required'])
                        ->markAsRequired()
                        ->unique('devices', 'serial_number', ignoreRecord: true)
                        ->label('Ident. číslo'),
                    TextInput::make('name')
                        ->label('Názov'),
                    TextInput::make('location')
                        ->label('Adresa'),
                    Toggle::make('active')
                        ->inline(false)
                        ->default(true)
                        ->label('Aktívne'),
                    UserSelect::factory()
                        ->multiple()
                        ->relationship('users', 'filament_label')
                        ->options(User::limit(25)->orderByDesc('id')->get()->pluck('filament_label', 'id')),
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
                TextColumnEnhanced::make('serial_number')
                    ->label('Ident. číslo'),
                TextColumnEnhanced::make('name')
                    ->label('Názov'),
                TextColumnEnhanced::make('location')
                    ->label('Adresa'),
                Tables\Columns\IconColumn::make('active')
                    ->label('Aktívne'),
                TextColumnEnhanced::make('users.filament_label')
                    ->listWithLineBreaks()
                    ->label('Používatelia')
                    ->listWithLineBreaks(),
            ])->defaultSort(self::$recordRouteKeyName, 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label('Aktívne'),
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
            'index' => Pages\ManageDevices::route('/'),
        ];
    }

    /**
     * @return Builder<Device>
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        return self::getResourceEloquentQuery($query);
    }

    /**
     * @param Builder<Device> $query
     * @return Builder<Device>
     */
    public static function getResourceEloquentQuery(Builder $query): Builder
    {
        // scope

        // join

        // select

        // with
        $query->with([
            'users',
        ]);

        return $query;
    }
}
