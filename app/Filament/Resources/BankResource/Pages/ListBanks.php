<?php

namespace App\Filament\Resources\BankResource\Pages;

use App\Filament\Resources\BankResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;


class ListBanks extends ListRecords
{
    protected static string $resource = BankResource::class;

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
            'brc' => Tab::make('Gereja BRC Sangatta')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'brc')),
            'yyp' => Tab::make('Yayasan → Paud')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'yyp')),
            'yys' => Tab::make('Yayasan → SD')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'yys')),
        ];
    }
}
