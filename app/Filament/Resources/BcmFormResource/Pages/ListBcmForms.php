<?php

namespace App\Filament\Resources\BcmFormResource\Pages;

use App\Filament\Resources\BcmFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBcmForms extends ListRecords
{
    protected static string $resource = BcmFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
