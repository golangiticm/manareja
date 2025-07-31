<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DonationPdfController extends Controller
{
    private function getPurposeLabel(string $code): string
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
    public function generate(Donation $donation)
    {

        $purposeLabel = $this->getPurposeLabel($donation->purpose);
        // $pdf = Pdf::loadView('pdf.donation', compact('donation'))->setPaper('a4', 'portrait');
        $pdf = Pdf::loadView('pdf.donation', [
            'donation' => $donation,
            'purposeLabel' => $purposeLabel,
        ])->setPaper('a4', 'portrait');
        return $pdf->download('donation-' . $donation->id . '.pdf');
    }
}
