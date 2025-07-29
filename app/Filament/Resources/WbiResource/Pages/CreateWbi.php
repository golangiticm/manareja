<?php

namespace App\Filament\Resources\WbiResource\Pages;

use App\Filament\Resources\WbiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWbi extends CreateRecord
{
    protected static string $resource = WbiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
