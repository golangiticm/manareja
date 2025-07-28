<?php

namespace App\Filament\Resources\KaderisasiResource\Pages;

use App\Filament\Resources\KaderisasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKaderisasi extends EditRecord
{
    protected static string $resource = KaderisasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
