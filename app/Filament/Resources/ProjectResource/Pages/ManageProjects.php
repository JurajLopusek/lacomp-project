<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Custom\Resource\ListRecordsEnhanced;
use App\Filament\Resources\ProjectResource;
use Filament\Actions;

class ManageProjects extends ListRecordsEnhanced
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
