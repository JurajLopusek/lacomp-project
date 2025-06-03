<?php

namespace App\Filament\Resources;

use App\Filament\Custom\Columns\IdColumnEnhanced;
use App\Filament\Custom\Columns\TextColumnEnhanced;
use App\Filament\Custom\Inputs\DeviceSelect;
use App\Filament\Custom\Resource\ResourceEnhanced;
use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\RolesRelationManager;
use App\Filament\Traits\CommonColumnsTrait;
use App\Models\Device;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends ResourceEnhanced
{
    use CommonColumnsTrait;

    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $label = 'Používateľ';
    protected static ?string $pluralLabel = 'Používatelia';
    protected static ?string $recordRouteKeyName = 'users.id';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::USERS->value;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('email_verified_at'),
                        Forms\Components\TextInput::make('password')
                            ->hiddenOn('edit')
                            ->password()
                            ->required()
                            ->maxLength(255),
                        DeviceSelect::factory()
                            ->multiple()
                            ->relationship('devices')
                            ->options(Device::limit(25)->orderByDesc('id')->get()->pluck('filament_label', 'id')),
                        Select::make('role_id')
                            ->relationship('roles', 'name')  // TODO MK: better way
                            ->multiple(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $table
            ->columns([
                IdColumnEnhanced::factory()
                    ->setWhereClauseAttribute(self::$recordRouteKeyName ?? ''),
                TextColumnEnhanced::make('name')
                    ->label('Meno'),
                TextColumnEnhanced::make('email')
                    ->label('Email'),
                TextColumnEnhanced::make('email_verified_at')
                    ->label('Verifikovanie emailu')
                    ->date()
                    ->copyable(),
                TextColumnEnhanced::make('devices.filament_label')
                    ->disableSort()
                    ->disableSearch()
                    ->listWithLineBreaks()
                    ->label('Zariadenia')
                    ->listWithLineBreaks(),
                TextColumnEnhanced::make('roles.name')
                    ->disableSearch()
                    ->disableSort()
                    ->listWithLineBreaks()
                    ->badge()
                    ->color('success')
                    ->label('Role'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ManageUsers::route('/'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RolesRelationManager::class,
        ];
    }

    /**
     * @return Builder<User>
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        return self::getResourceEloquentQuery($query);
    }

    /**
     * @param Builder<User> $query
     * @return Builder<User>
     */
    public static function getResourceEloquentQuery(Builder $query): Builder
    {
        // scope

        // join

        // select

        // with
        $query->with([
            'roles',
            'devices',
        ]);

        return $query;
    }
}
