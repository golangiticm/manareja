<?php

namespace App\Filament\Resources\QrisResource\Pages;

use App\Filament\Resources\QrisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQris extends ListRecords
{
    protected static string $resource = QrisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
