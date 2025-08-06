<?php

namespace App\Exports;

use App\Models\Donation;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DonationsExport implements FromCollection, WithHeadings
{
    public function __construct(
        protected ?string $purpose = null,
        protected ?bool $isApproved = null,
    ) {}

    public function collection()
    {
        $query = Donation::query();

        if ($this->purpose) {
            $query->where('purpose', $this->purpose);
        }

        if (!is_null($this->isApproved)) {
            $query->where('is_approved', $this->isApproved);
        }

        return $query->get()->map(function ($donation) {
            return [
                'Nama Donatur' => $donation->donor_name ?? User::find($donation->user_id)->name,
                'Jumlah' => $donation->amount,
                'Tujuan' => $this->mapPurpose($donation->purpose),
                'Pesan' => $donation->message,
                'Status' => $donation->is_approved ? 'Approved' : 'Rejected',
                'Tanggal Donasi' => $donation->created_at->format('d-m-Y H:i'),
            ];
        });
    }

    private function mapPurpose(string $code): string
    {
        return [
            '000' => 'Persembahan',
            '010' => 'Persepuluhan',
            '020' => 'Pembangunan',
            '005' => 'Diakonia/Peduli Kasih',
            '015' => 'Ucapan Syukur',
            '025' => 'HUT/Natal/Paskah',
            '030' => 'Misi',
            '035' => 'Komitmen Videotron',
        ][$code] ?? $code;
    }

    public function headings(): array
    {
        return [
            'Nama Donatur',
            'Jumlah',
            'Tujuan',
            'Pesan',
            'Disetujui',
            'Tanggal Donasi',
        ];
    }
}
