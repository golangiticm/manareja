<?php

namespace App\Filament\Resources\DonationResource\Pages;

use App\Filament\Resources\DonationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Forms;

class ListDonations extends ListRecords
{
    protected static string $resource = DonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('Export Filtered')
                ->icon('heroicon-o-arrow-down-tray')
                ->label('Export Filter')
                ->color('success')
                ->form([
                    Forms\Components\Select::make('purpose')
                        ->label('Tujuan')
                        ->options([
                            '000' => 'Persembahan',
                            '010' => 'Persepuluhan',
                            '020' => 'Pembangunan',
                            '005' => 'Diakonia/Peduli Kasih',
                            '015' => 'Ucapan Syukur',
                            '025' => 'HUT/Natal/Paskah',
                            '030' => 'Misi',
                            '035' => 'Komitmen Videotron',
                        ])
                        ->searchable()
                        ->placeholder('Semua'),
                    Forms\Components\Select::make('is_approved')
                        ->label('Status Persetujuan')
                        ->options([
                            '1' => 'Approved',
                            '0' => 'Rejected',
                        ])
                        ->placeholder('Semua'),
                ])
                ->action(function (array $data) {
                    $query = http_build_query([
                        'purpose' => $data['purpose'] ?? null,
                        'approved' => $data['is_approved'] !== null ? (bool)$data['is_approved'] : null,
                    ]);

                    return redirect()->away(route('donations.export') . '?' . $query);
                })
        ];
    }

    // public function getTabs1(): array
    // {
    //     return [
    //         'all' => Tab::make('Semua'),
    //         '000' => Tab::make('Persembahan')
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '000')),
    //         '010' => Tab::make('Persepuluhan')
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '010')),
    //         '020' => Tab::make('Pembangunan')
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '020')),
    //         '005' => Tab::make('Diakonia')
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '005')),
    //         '015' => Tab::make('Ucapan Syukur')
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '015')),
    //         '025' => Tab::make('HUT/Natal/Paskah')
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '025')),
    //         '030' => Tab::make('Misi')
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '030')),
    //         '035' => Tab::make('Komitmen Videotron')
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '035')),
    //     ];
    // }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            true => Tab::make('Approved')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_approved', true)),
            false => Tab::make('Rejected')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_approved', false)),
        ];
    }
}
