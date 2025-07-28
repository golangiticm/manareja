<?php

namespace App\Filament\Resources\RbiResource\Pages;

use App\Filament\Resources\RbiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRbi extends EditRecord
{
    protected static string $resource = RbiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
