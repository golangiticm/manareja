<?php

namespace App\Filament\Resources\BcmFormResource\Pages;

use App\Filament\Resources\BcmFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBcmForm extends EditRecord
{
    protected static string $resource = BcmFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
