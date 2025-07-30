<?php

namespace App\Filament\Resources\DonationResource\Pages;

use App\Filament\Resources\DonationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;

class ListDonations extends ListRecords
{
    protected static string $resource = DonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua'),
            '000' => Tab::make('Persembahan')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '000')),
            '010' => Tab::make('Persepuluhan')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '010')),
            '020' => Tab::make('Pembangunan')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '020')),
            '005' => Tab::make('Diakonia')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '005')),
            '015' => Tab::make('Ucapan Syukur')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '015')),
            '025' => Tab::make('HUT/Natal/Paskah')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '025')),
            '030' => Tab::make('Misi')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '030')),
            '035' => Tab::make('Komitmen Videotron')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('purpose', '035')),
        ];
    }

    
}
