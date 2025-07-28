<?php

namespace App\Filament\Resources\MogResource\Pages;

use App\Filament\Resources\MogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMog extends EditRecord
{
    protected static string $resource = MogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
