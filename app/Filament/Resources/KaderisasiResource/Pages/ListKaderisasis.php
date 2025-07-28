<?php

namespace App\Filament\Resources\KaderisasiResource\Pages;

use App\Filament\Resources\KaderisasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKaderisasis extends ListRecords
{
    protected static string $resource = KaderisasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data'),
        ];
    }
}
