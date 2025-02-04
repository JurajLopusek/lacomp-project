<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Custom\Resource\ListRecordsEnhanced;
use App\Filament\Resources\UserResource;
use Filament\Actions;

class ManageUsers extends ListRecordsEnhanced
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
