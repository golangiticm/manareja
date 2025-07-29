<?php

namespace App\Filament\Resources\GalleryVideoProgramResource\Pages;

use App\Filament\Resources\GalleryVideoProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleryVideoPrograms extends ListRecords
{
    protected static string $resource = GalleryVideoProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
