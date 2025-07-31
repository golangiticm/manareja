<?php

namespace App\Filament\Resources\BoomResource\Pages;

use App\Filament\Resources\BoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBooms extends ListRecords
{
    protected static string $resource = BoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data'),
            Actions\Action::make('Cetak Semua')
                ->label('Cetak Bulan Ini')
                ->icon('heroicon-o-printer')
                ->url(route('services.print.all', 'BOOM'))
                ->color('primary')
                ->openUrlInNewTab(),
        ];
    }
}
