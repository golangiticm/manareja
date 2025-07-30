<?php

namespace App\Filament\Resources\QrisResource\Pages;

use App\Filament\Resources\QrisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQris extends EditRecord
{
    protected static string $resource = QrisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
