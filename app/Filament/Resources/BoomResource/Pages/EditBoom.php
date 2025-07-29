<?php

namespace App\Filament\Resources\BoomResource\Pages;

use App\Filament\Resources\BoomResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBoom extends EditRecord
{
    protected static string $resource = BoomResource::class;

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
