<?php

namespace App\Filament\Resources\GalleryProgramResource\Pages;

use App\Filament\Resources\GalleryProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGalleryProgram extends EditRecord
{
    protected static string $resource = GalleryProgramResource::class;

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
