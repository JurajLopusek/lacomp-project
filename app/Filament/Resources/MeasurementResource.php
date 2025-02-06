<?php

namespace App\Filament\Resources;

use App\Filament\Custom\Columns\IdColumnEnhanced;
use App\Filament\Custom\Columns\TextColumnEnhanced;
use App\Filament\Custom\Resource\ResourceEnhanced;
use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Resources\MeasurementResource\Pages;
use App\Filament\Traits\CommonColumnsTrait;
use App\Models\Measurement;
use Filament\Tables;
use Filament\Tables\Table;

class MeasurementResource extends ResourceEnhanced
{
    use CommonColumnsTrait;

    protected static ?string $model = Measurement::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Meranie';
    protected static ?string $pluralLabel = 'Merania';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::DEVICE->value;
    protected static ?string $recordRouteKeyName = 'measurements.id';

    public static function table(Table $table): Table
    {
        $table
            ->columns([
                IdColumnEnhanced::factory()
                    ->setWhereClauseAttribute(self::$recordRouteKeyName),
                TextColumnEnhanced::make('device.name'),
                TextColumnEnhanced::make('electricity'),
                TextColumnEnhanced::make('electricity_panel'),
                TextColumnEnhanced::make('gas'),
                TextColumnEnhanced::make('water'),
                TextColumnEnhanced::make('outside_temperature'),
                TextColumnEnhanced::make('time')
                    ->dateTime(),
            ])->defaultSort(self::$recordRouteKeyName, 'desc')
            ->filters([
                //
            ])
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
            'index' => Pages\ManageMeasurements::route('/'),
        ];
    }
}
