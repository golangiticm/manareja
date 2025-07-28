<?php

namespace App\Filament\Resources\CsrResource\Pages;

use App\Filament\Resources\CsrResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCsrs extends ListRecords
{
    protected static string $resource = CsrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data'),
        ];
    }
}
