<?php

namespace App\Filament\Resources\DonationYayasanResource\Pages;

use App\Filament\Resources\DonationYayasanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDonationYayasan extends EditRecord
{
    protected static string $resource = DonationYayasanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
