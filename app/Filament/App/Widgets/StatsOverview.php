<?php

namespace App\Filament\App\Widgets;

use App\Models\Announcement;
use App\Models\Donation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {

        return [

            Stat::make('Total Donasi', 'Rp. ' . number_format(
                Donation::where('is_approved', true)->where('user_id', Auth::user()->id)->sum('amount'),
                0,
                ',',
                '.'
            ))
                ->description('Akumulasi seluruh donasi yang disetujui')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Announcement', Announcement::where('is_publish', true)->count())
                ->description('Pengumuman Terbaru')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('danger'), 
        ];
    }
}
