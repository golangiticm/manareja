<?php

namespace App\Filament\Resources\WeddingFormResource\Pages;

use App\Filament\Resources\WeddingFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeddingForms extends ListRecords
{
    protected static string $resource = WeddingFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
