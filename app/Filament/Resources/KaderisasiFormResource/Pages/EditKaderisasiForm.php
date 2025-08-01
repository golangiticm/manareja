<?php

namespace App\Filament\Resources\KaderisasiFormResource\Pages;

use App\Filament\Resources\KaderisasiFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKaderisasiForm extends EditRecord
{
    protected static string $resource = KaderisasiFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
