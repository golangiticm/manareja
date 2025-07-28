<?php

namespace App\Filament\Resources\MogResource\Pages;

use App\Filament\Resources\MogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMogs extends ListRecords
{
    protected static string $resource = MogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Jadwal'),
        ];
    }
}
