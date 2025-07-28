<?php

namespace App\Filament\Resources\BcmResource\Pages;

use App\Filament\Resources\BcmResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBcm extends EditRecord
{
    protected static string $resource = BcmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
