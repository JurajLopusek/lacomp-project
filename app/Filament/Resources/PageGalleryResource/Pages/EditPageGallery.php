<?php

namespace App\Filament\Resources\PageGalleryResource\Pages;

use App\Filament\Resources\PageGalleryResource;
use App\Models\PageGallery;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditPageGallery extends EditRecord
{
    protected static string $resource = PageGalleryResource::class;

    public function getTitle(): string
    {
        /** @var PageGallery $record */
        $record = $this->getRecord();

        return "Fotky – {$record->filament_label}";
    }

    /**
     * Can't save while the uploaded hero photo has a wrong size (error set right after upload).
     */
    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->disabled(fn () => $this->getErrorBag()->has('data.hero_image'))
            ->tooltip(fn () => $this->getErrorBag()->has('data.hero_image') ? 'Najprv nahrajte hlavnú fotku správnej veľkosti.' : null);
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}
