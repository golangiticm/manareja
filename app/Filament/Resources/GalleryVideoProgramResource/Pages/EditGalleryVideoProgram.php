<?php

namespace App\Filament\Resources\GalleryVideoProgramResource\Pages;

use App\Filament\Resources\GalleryVideoProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGalleryVideoProgram extends EditRecord
{
    protected static string $resource = GalleryVideoProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
