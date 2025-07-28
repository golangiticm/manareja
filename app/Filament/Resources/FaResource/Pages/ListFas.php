<?php

namespace App\Filament\Resources\FaResource\Pages;

use App\Filament\Resources\FaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFas extends ListRecords
{
    protected static string $resource = FaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data'),
        ];
    }
}
