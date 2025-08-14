<?php

namespace App\Filament\App\Resources\DonationYayasanResource\Pages;

use App\Filament\App\Resources\DonationYayasanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonationYayasans extends ListRecords
{
    protected static string $resource = DonationYayasanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
