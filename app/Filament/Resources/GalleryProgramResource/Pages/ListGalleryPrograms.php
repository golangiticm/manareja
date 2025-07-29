<?php

namespace App\Filament\Resources\GalleryProgramResource\Pages;

use App\Filament\Resources\GalleryProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleryPrograms extends ListRecords
{
    protected static string $resource = GalleryProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
