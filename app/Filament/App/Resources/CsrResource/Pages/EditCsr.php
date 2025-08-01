<?php

namespace App\Filament\App\Resources\CsrResource\Pages;

use App\Filament\App\Resources\CsrResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCsr extends EditRecord
{
    protected static string $resource = CsrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
