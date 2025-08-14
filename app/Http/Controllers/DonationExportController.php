<?php

namespace App\Http\Controllers;

use App\Exports\DonationsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DonationExportController extends Controller
{
    public function export(Request $request)
    {
        $purpose = $request->get('purpose');
        $approved = $request->get('approved');
        $type = $request->get('type');

        // dd($type);
        return Excel::download(
            new DonationsExport($purpose, $approved, $type),
            'filtered-donations.xlsx'
        );
    }
}
