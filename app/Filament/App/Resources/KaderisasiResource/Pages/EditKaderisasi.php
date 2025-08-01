<?php

namespace App\Filament\App\Resources\KaderisasiResource\Pages;

use App\Filament\App\Resources\KaderisasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKaderisasi extends EditRecord
{
    protected static string $resource = KaderisasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
