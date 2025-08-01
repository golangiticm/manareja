<?php

namespace App\Filament\App\Resources\BcmResource\Pages;

use App\Filament\App\Resources\BcmResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBcms extends ListRecords
{
    protected static string $resource = BcmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
