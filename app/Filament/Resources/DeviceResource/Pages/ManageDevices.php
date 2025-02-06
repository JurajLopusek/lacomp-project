<?php

namespace App\Filament\Resources\DeviceResource\Pages;

use App\Filament\Custom\Resource\ListRecordsEnhanced;
use App\Filament\Resources\DeviceResource;
use Filament\Actions;

class ManageDevices extends ListRecordsEnhanced
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
