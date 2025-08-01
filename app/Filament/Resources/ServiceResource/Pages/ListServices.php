<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Forms;

use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Jadwal'),
            Actions\Action::make('Cetak Semua')
                ->label('Cetak')
                ->icon('heroicon-o-printer')
                ->form([
                    Forms\Components\Select::make('month')
                        ->label('Bulan')
                        ->options([
                            '1' => 'Januari',
                            '2' => 'Februari',
                            '3' => 'Maret',
                            '4' => 'April',
                            '5' => 'Mei',
                            '6' => 'Juni',
                            '7' => 'Juli',
                            '8' => 'Agustus',
                            '9' => 'September',
                            '10' => 'Oktober',
                            '11' => 'November',
                            '12' => 'Desember',
                        ])
                        ->required(),
                    Forms\Components\Select::make('year')
                        ->label('Tahun')
                        ->options(collect(range(now()->year + 1, now()->year - 5))->mapWithKeys(fn($y) => [$y => $y]))
                        ->required(),
                ])
                ->action(function (array $data) {
                    $url = route('services.print.all', [
                        'type' => 'IBADAH RAYA',
                        'month' => $data['month'],
                        'year' => $data['year'],
                    ]);

                    return redirect()->away($url); // agar langsung membuka PDF di tab baru
                })
                ->openUrlInNewTab()
                ->color('primary')

        ];
    }
}
