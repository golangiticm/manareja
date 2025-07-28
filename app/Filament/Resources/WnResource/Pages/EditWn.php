<?php

namespace App\Filament\Resources\WnResource\Pages;

use App\Filament\Resources\WnResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWn extends EditRecord
{
    protected static string $resource = WnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
