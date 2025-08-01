<?php

namespace App\Filament\Resources\BaptismResource\Pages;

use App\Filament\Resources\BaptismResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBaptism extends EditRecord
{
    protected static string $resource = BaptismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
