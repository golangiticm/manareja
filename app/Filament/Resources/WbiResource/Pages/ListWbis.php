<?php

namespace App\Filament\Resources\WbiResource\Pages;

use App\Filament\Resources\WbiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWbis extends ListRecords
{
    protected static string $resource = WbiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data'),
            Actions\Action::make('Cetak Semua')
                ->label('Cetak Bulan Ini')
                ->icon('heroicon-o-printer')
                ->url(route('services.print.all', 'WBI'))
                ->color('primary')
                ->openUrlInNewTab(),
        ];
    }
}
