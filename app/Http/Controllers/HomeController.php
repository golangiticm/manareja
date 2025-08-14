<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Donation;
use App\Models\Home;
use App\Models\Jemaat;
use App\Models\Program;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $jemaat = Jemaat::count();
        $donasiBRC = Donation::where('is_approved', true)->where('type','brc')->sum('amount');
        $donasiYYS = Donation::where('is_approved', true)->where('type','yys')->sum('amount');
        $announcements = Announcement::where('is_publish', true)->orderByDesc('published_at')
            ->take(6) // atau paginate()
            ->get();
        return view('components.web.home', compact('announcements', 'jemaat', 'donasiYYS', 'donasiBRC'));
    }
}
