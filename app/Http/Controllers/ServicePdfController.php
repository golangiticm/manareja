<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ServicePdfController extends Controller
{
    public function printAll(Request $request, string $type)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $query = Service::with('officer_service_assigments.officer', 'officer_service_assigments.user');

        if ($type === 'FA') {
            $query->with('officer_service_fas.group');
        }

        $services = $query
            ->where('type', $type)
            ->whereMonth('held_at', $month)
            ->whereYear('held_at', $year)
            ->orderBy('held_at')
            ->get();

        $pdf = Pdf::loadView('pdf.all-services', compact('services', 'type', 'month', 'year'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("jadwal-ibadah-$month-$year.pdf");
    }
}
