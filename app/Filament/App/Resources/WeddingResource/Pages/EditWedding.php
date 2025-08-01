<?php

namespace App\Filament\App\Resources\WeddingResource\Pages;

use App\Filament\App\Resources\WeddingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWedding extends EditRecord
{
    protected static string $resource = WeddingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
