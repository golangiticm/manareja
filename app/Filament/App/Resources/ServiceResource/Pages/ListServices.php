<?php

namespace App\Filament\App\Resources\ServiceResource\Pages;

use App\Filament\App\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms;


class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Cetak Semua')
                ->label('Cetak')
                ->icon('heroicon-o-printer')
                ->form([
                    Forms\Components\Select::make('type')
                        ->label('Service')
                        ->options([
                            'IBADAH RAYA' => 'Ibadah Raya',
                            'MOG' => 'Message Of God',
                            'DOA' => 'Doa',
                            'BOOM' => 'Blessing Out Of Mercy',
                            'WBI' => 'Wanita Bethel Indonesia',
                            'RBI' => 'Remaja Bethel Indonesia',
                            'WN' => 'Wanita',
                            'FA' => 'Family Althar',
                        ])
                        ->preload()
                        ->searchable()
                        ->required(),
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
                        ->preload()
                        ->searchable()
                        ->required(),
                    Forms\Components\Select::make('year')
                        ->label('Tahun')
                        ->options(collect(range(now()->year + 1, now()->year - 5))->mapWithKeys(fn($y) => [$y => $y]))
                        ->required()
                        ->preload()
                        ->searchable(),
                ])
                ->action(function (array $data) {
                    $url = route('services.print.all', [
                        'type' => $data['type'],
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
