<?php

namespace App\Filament\Resources;

use App\Filament\Custom\Columns\IdColumnEnhanced;
use App\Filament\Custom\Columns\Relations\DeviceColumnEnhanced;
use App\Filament\Custom\Columns\TextColumnEnhanced;
use App\Filament\Custom\Filters\DeviceFilter;
use App\Filament\Custom\Resource\ResourceEnhanced;
use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Interfaces\ResourceEloquentQueryInterface;
use App\Filament\Resources\MeasurementResource\Pages;
use App\Filament\Traits\CommonColumnsTrait;
use App\Models\Measurement;
use Exception;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MeasurementResource extends ResourceEnhanced implements ResourceEloquentQueryInterface
{
    use CommonColumnsTrait;

    protected static ?string $model = Measurement::class;
    protected static ?string $navigationIcon = 'phosphor-gauge';
    protected static ?string $label = 'Meranie';
    protected static ?string $pluralLabel = 'Merania';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::DEVICE->value;
    protected static ?string $recordRouteKeyName = 'measurements.id';

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        $table
            ->columns([
                IdColumnEnhanced::factory()
                    ->setWhereClauseAttribute(self::$recordRouteKeyName ?? ''),
                DeviceColumnEnhanced::factory(),
                TextColumnEnhanced::make('electricity')
                    ->label('Elektrika'),
                TextColumnEnhanced::make('electricity_panel')
                    ->label('Elektrický panel'),
                TextColumnEnhanced::make('gas')
                    ->label('Plyn'),
                TextColumnEnhanced::make('water')
                    ->label('Voda'),
                TextColumnEnhanced::make('outside_temperature')
                    ->label('Teplota'),
                TextColumnEnhanced::make('time')
                    ->label('Čas')
                    ->dateTime(),
            ])->defaultSort(self::$recordRouteKeyName, 'desc')
            ->filters([
                DeviceFilter::factory(),
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
            'index' => Pages\ManageMeasurements::route('/'),
        ];
    }

    /**
     * @return Builder<Measurement>
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        return self::getResourceEloquentQuery($query);
    }

    /**
     * @param Builder<Measurement> $query
     * @return Builder<Measurement>
     */
    public static function getResourceEloquentQuery(Builder $query): Builder
    {
        // scope

        // join
        $query->leftJoin('devices', 'measurements.device_id', '=', 'devices.id');

        // select
        $query->select(['measurements.*']);

        // with
        $query->with([
            'device',
        ]);

        return $query;
    }
}
