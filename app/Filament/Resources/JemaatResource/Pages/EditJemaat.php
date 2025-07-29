<?php

namespace App\Filament\Resources\JemaatResource\Pages;

use App\Filament\Resources\JemaatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJemaat extends EditRecord
{
    protected static string $resource = JemaatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
