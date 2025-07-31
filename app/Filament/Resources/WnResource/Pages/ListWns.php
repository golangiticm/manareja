<?php

namespace App\Filament\Resources\WnResource\Pages;

use App\Filament\Resources\WnResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWns extends ListRecords
{
    protected static string $resource = WnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data'),
            Actions\Action::make('Cetak Semua')
                ->label('Cetak Bulan Ini')
                ->icon('heroicon-o-printer')
                ->url(route('services.print.all', 'WN'))
                ->color('primary')
                ->openUrlInNewTab(),
        ];
    }
}
