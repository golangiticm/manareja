<?php

namespace App\Filament\Resources\RbiResource\Pages;

use App\Filament\Resources\RbiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRbis extends ListRecords
{
    protected static string $resource = RbiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data'),
            Actions\Action::make('Cetak Semua')
                ->label('Cetak Bulan Ini')
                ->icon('heroicon-o-printer')
                ->url(route('services.print.all', 'RBI'))
                ->color('primary')
                ->openUrlInNewTab(),
        ];
    }
}
