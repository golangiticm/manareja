<?php

namespace App\Filament\Resources\DonationYayasanResource\Pages;

use App\Filament\Resources\DonationYayasanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Forms;

class ListDonationYayasans extends ListRecords
{
    protected static string $resource = DonationYayasanResource::class;

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
                    Forms\Components\Hidden::make('type')
                        ->default('yys'),
                ])
                ->action(function (array $data) {
                    $query = http_build_query([
                        'purpose' => $data['purpose'] ?? null,
                        'approved' => $data['is_approved'] !== null ? (bool)$data['is_approved'] : null,
                        'type' => $data['type'],
                    ]);

                    return redirect()->away(route('donations.export') . '?' . $query);
                })
        ];
    }

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
