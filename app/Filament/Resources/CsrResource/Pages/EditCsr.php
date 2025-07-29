<?php

namespace App\Filament\Resources\CsrResource\Pages;

use App\Filament\Resources\CsrResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCsr extends EditRecord
{
    protected static string $resource = CsrResource::class;

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
