<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Jadwal'),
            Actions\Action::make('Cetak Semua')
                ->label('Cetak Bulan Ini')
                ->icon('heroicon-o-printer')
                ->url(route('services.print.all', 'IBADAH RAYA'))
                ->color('primary')
                ->openUrlInNewTab(),

        ];
    }
}
