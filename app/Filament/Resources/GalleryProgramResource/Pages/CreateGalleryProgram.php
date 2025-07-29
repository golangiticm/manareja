<?php

namespace App\Filament\Resources\GalleryProgramResource\Pages;

use App\Filament\Resources\GalleryProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGalleryProgram extends CreateRecord
{
    protected static string $resource = GalleryProgramResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
