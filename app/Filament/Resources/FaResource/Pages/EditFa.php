<?php

namespace App\Filament\Resources\FaResource\Pages;

use App\Filament\Resources\FaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFa extends EditRecord
{
    protected static string $resource = FaResource::class;

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
