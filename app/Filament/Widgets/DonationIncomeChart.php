<?php

namespace App\Filament\Widgets;

use App\Models\Donation;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class DonationIncomeChart extends ChartWidget
{

    protected static ?string $heading = 'Grafik Pendapatan Donasi Tahunan';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $year = now()->year;

        $donations = Donation::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->whereYear('created_at', $year)
            ->where('is_approved', true)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Inisialisasi 12 bulan dengan 0
        $labels = [];
        $data = [];

        foreach (range(1, 12) as $month) {
            $labels[] = Carbon::create()->month($month)->locale('id')->translatedFormat('F');
            $data[] = $donations[$month] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => "Donasi Bulanan - $year",
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
