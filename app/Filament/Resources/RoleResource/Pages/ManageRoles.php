<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Custom\Resource\ListRecordsEnhanced;
use App\Filament\Resources\RoleResource;
use Filament\Actions;

class ManageRoles extends ListRecordsEnhanced
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
