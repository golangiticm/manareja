<?php

namespace App\Filament\Resources\RbiResource\Pages;

use App\Filament\Resources\RbiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRbis extends ListRecords
{
    protected static string $resource = RbiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data'),
        ];
    }
}
