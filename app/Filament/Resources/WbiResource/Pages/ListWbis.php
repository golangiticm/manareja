<?php

namespace App\Filament\Resources\WbiResource\Pages;

use App\Filament\Resources\WbiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWbis extends ListRecords
{
    protected static string $resource = WbiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data'),
        ];
    }
}
