<?php

namespace App\Filament\Resources\KaderisasiFormResource\Pages;

use App\Filament\Resources\KaderisasiFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKaderisasiForms extends ListRecords
{
    protected static string $resource = KaderisasiFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
