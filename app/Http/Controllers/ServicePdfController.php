<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ServicePdfController extends Controller
{
    public function printAll(string $type)
    {

        $now = Carbon::now();
        $services = Service::with('officer_service_assigments.officer', 'officer_service_assigments.user')
            ->where('type', $type)
            ->whereMonth('held_at', $now->month)
            ->whereYear('held_at', $now->year)
            ->orderBy('held_at')
            ->get();

        $pdf = Pdf::loadView('pdf.all-services', compact('services', 'type'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('jadwal-ibadah-semua.pdf');
    }
}
