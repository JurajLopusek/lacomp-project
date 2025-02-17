<?php

namespace App\Filament\Resources;

use App\Filament\Custom\Columns\IdColumnEnhanced;
use App\Filament\Custom\Columns\Relations\DeviceColumnEnhanced;
use App\Filament\Custom\Columns\TextColumnEnhanced;
use App\Filament\Custom\Filters\DeviceFilter;
use App\Filament\Custom\Resource\ResourceEnhanced;
use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Resources\CalculationResource\Pages;
use App\Filament\Traits\CommonColumnsTrait;
use App\Models\Calculation;
use Exception;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CalculationResource extends ResourceEnhanced
{
    use CommonColumnsTrait;

    protected static ?string $model = Calculation::class;
    protected static ?string $navigationIcon = 'phosphor-calculator';
    protected static ?string $label = 'Výpočty';
    protected static ?string $pluralLabel = 'Výpočet';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::DEVICE->value;
    protected static ?string $recordRouteKeyName = 'calculations.id';

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        $table->columns([
            IdColumnEnhanced::factory()
                ->setWhereClauseAttribute(self::$recordRouteKeyName),
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
                ->label('Čas'),
        ])->defaultSort(self::$recordRouteKeyName, 'desc')
            ->actions([
                DeleteAction::make(),
            ])
            ->filters([
                DeviceFilter::factory(),
            ], layout: FiltersLayout::AboveContentCollapsible);

        return parent::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCalculations::route('/'),
        ];
    }

    /**
     * @return Builder<Calculation>
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        return self::getResourceEloquentQuery($query);
    }

    /**
     * @param Builder<Calculation> $query
     * @return Builder<Calculation>
     */
    public static function getResourceEloquentQuery(Builder $query): Builder
    {
        // scope

        // join
        $query->leftJoin('devices', 'calculations.device_id', '=', 'devices.id');

        // select
        $query->select(['calculations.*']);

        // with
        $query->with([
            'device',
        ]);

        return $query;
    }
}
