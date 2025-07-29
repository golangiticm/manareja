<?php

namespace App\Filament\Resources\DoaResource\Pages;

use App\Filament\Resources\DoaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDoa extends EditRecord
{
    protected static string $resource = DoaResource::class;

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
