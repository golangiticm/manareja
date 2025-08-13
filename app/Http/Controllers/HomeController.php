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
        $home = Home::first();
        $jemaat = Jemaat::count();
        $service = Service::count();
        $program = Program::count();
        $donasi = Donation::where('is_approved', true)->sum('amount');
        $announcements = Announcement::where('is_publish', true)->orderByDesc('published_at')
            ->take(6) // atau paginate()
            ->get();
        return view('components.web.home', compact('announcements', 'jemaat', 'service', 'program', 'donasi',));
    }
}
