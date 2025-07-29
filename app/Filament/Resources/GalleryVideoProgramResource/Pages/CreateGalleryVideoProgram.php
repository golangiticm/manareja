<?php

namespace App\Filament\Resources\GalleryVideoProgramResource\Pages;

use App\Filament\Resources\GalleryVideoProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGalleryVideoProgram extends CreateRecord
{
    protected static string $resource = GalleryVideoProgramResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
