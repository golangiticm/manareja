<?php

namespace App\Filament\Resources\CsrFormResource\Pages;

use App\Filament\Resources\CsrFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCsrForms extends ListRecords
{
    protected static string $resource = CsrFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
