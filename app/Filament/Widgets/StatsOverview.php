<?php

namespace App\Filament\Widgets;

use App\Models\Donation;
use App\Models\Group;
use App\Models\User;
use Filament\Forms\Components\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {

        return [

            Stat::make('Total Donasi', 'Rp. ' . number_format(
                Donation::where('is_approved', true)->sum('amount'),
                0,
                ',',
                '.'
            ))
                ->description('Akumulasi seluruh donasi yang disetujui')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Total User', User::count())
                ->description('Jumlah user terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
            Stat::make('Total Group', Group::count())
                ->description('Jumlah Group terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('secondary'),
        ];
    }
}
