<?php

namespace App\Filament\Resources;

use App\Filament\Custom\Columns\IdColumnEnhanced;
use App\Filament\Custom\Columns\TextColumnEnhanced;
use App\Filament\Custom\Resource\ResourceEnhanced;
use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\RolesRelationManager;
use App\Filament\Traits\CommonColumnsTrait;
use App\Models\User;
use Filament\Forms;
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
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('email_verified_at'),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $table
            ->columns([
                IdColumnEnhanced::factory()
                    ->setWhereClauseAttribute(self::$recordRouteKeyName),
                TextColumnEnhanced::make('name'),
                TextColumnEnhanced::make('email'),
                TextColumnEnhanced::make('email_verified_at')
                    ->dateTime(),
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

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        return self::getResourceEloquentQuery($query);
    }

    public static function getResourceEloquentQuery(Builder $query): Builder
    {
        // scope

        // join

        // select

        // with
        $query->with([
            'roles',
        ]);

        return $query;
    }
}
