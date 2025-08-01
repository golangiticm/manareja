<?php

namespace App\Filament\App\Resources\BaptismResource\Pages;

use App\Filament\App\Resources\BaptismResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBaptisms extends ListRecords
{
    protected static string $resource = BaptismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
