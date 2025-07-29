<?php

namespace App\Filament\Resources\BoomResource\Pages;

use App\Filament\Resources\BoomResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBoom extends CreateRecord
{
    protected static string $resource = BoomResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
