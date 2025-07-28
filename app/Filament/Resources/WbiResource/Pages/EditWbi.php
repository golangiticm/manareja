<?php

namespace App\Filament\Resources\WbiResource\Pages;

use App\Filament\Resources\WbiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWbi extends EditRecord
{
    protected static string $resource = WbiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
