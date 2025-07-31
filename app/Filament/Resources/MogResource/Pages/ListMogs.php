<?php

namespace App\Filament\Resources\MogResource\Pages;

use App\Filament\Resources\MogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMogs extends ListRecords
{
    protected static string $resource = MogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Jadwal'),
            Actions\Action::make('Cetak Semua')
                ->label('Cetak Semua Jadwal')
                ->icon('heroicon-o-printer')
                ->url(route('services.print.all', 'MOG'))
                ->color('primary')
                ->openUrlInNewTab(),
        ];
    }
}
