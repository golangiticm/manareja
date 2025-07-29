<?php

namespace App\Filament\Resources\MogResource\Pages;

use App\Filament\Resources\MogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMog extends CreateRecord
{
    protected static string $resource = MogResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
