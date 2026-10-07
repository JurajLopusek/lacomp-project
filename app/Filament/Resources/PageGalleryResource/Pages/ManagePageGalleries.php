<?php

namespace App\Filament\Resources\PageGalleryResource\Pages;

use App\Filament\Custom\Resource\ListRecordsEnhanced;
use App\Filament\Resources\PageGalleryResource;
use App\Models\PageGallery;
use Filament\Actions;

class ManagePageGalleries extends ListRecordsEnhanced
{
    protected static string $resource = PageGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                // every page has just one gallery
                ->visible(fn () => PageGallery::query()->count() < count(PageGallery::PAGES)),
        ];
    }
}
