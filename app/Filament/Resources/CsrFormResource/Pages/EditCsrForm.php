<?php

namespace App\Filament\Resources\CsrFormResource\Pages;

use App\Filament\Resources\CsrFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCsrForm extends EditRecord
{
    protected static string $resource = CsrFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
