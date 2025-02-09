<?php

namespace App\Filament\Resources;

use App\Filament\Custom\Columns\IdColumnEnhanced;
use App\Filament\Custom\Columns\TextColumnEnhanced;
use App\Filament\Custom\Resource\ResourceEnhanced;
use App\Filament\Enums\FilamentPanelNavigationGroupEnum;
use App\Filament\Resources\DeviceResource\Pages;
use App\Filament\Traits\CommonColumnsTrait;
use App\Models\Device;
use Filament\Tables;
use Filament\Tables\Table;

class DeviceResource extends ResourceEnhanced
{
    use CommonColumnsTrait;

    protected static ?string $model = Device::class;
    protected static ?string $navigationIcon = 'phosphor-usb';
    protected static ?string $label = 'Zariadenie';
    protected static ?string $pluralLabel = 'Zariadenia';
    protected static ?string $navigationGroup = FilamentPanelNavigationGroupEnum::DEVICE->value;
    protected static ?string $recordRouteKeyName = 'devices.id';

    public static function table(Table $table): Table
    {
        $table
            ->columns([
                IdColumnEnhanced::factory(),
                TextColumnEnhanced::make('serial_number'),
                TextColumnEnhanced::make('name'),
                TextColumnEnhanced::make('location'),
                Tables\Columns\IconColumn::make('active'),
            ])->defaultSort(self::$recordRouteKeyName, 'desc')
            ->filters([
                //
            ])
            ->actions([
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
}
