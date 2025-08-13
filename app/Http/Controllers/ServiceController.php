<?php

namespace App\Http\Controllers;

use App\Models\Boom;
use App\Models\Doa;
use App\Models\Fa;
use App\Models\Group;
use App\Models\Ir;
use App\Models\Mog;
use App\Models\Rbi;
use App\Models\Service;
use App\Models\Wbi;
use App\Models\Wn;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boom = Boom::first();
        $doa = Doa::first();
        $fa = Fa::first();
        $mog = Mog::first();
        $rbi = Rbi::first();
        $ir = Ir::first();
        $wbi = Wbi::first();
        $wn = Wn::first();

        // $groups = Group::all();
        $groups = Group::with('users')
            ->with('leaderUser')
            ->get();


        return view('components.web.service', compact('boom', 'doa', 'fa', 'mog', 'rbi', 'ir', 'wbi', 'wn', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type)
    {
        $query = Service::where('type', $type)
            ->with('officer_service_assigments.officer', 'officer_service_assigments.user')
            ->whereDate('held_at', '>=', Carbon::today())
            ->orderBy('held_at');

        if ($type === 'FA') {
            $query->with('officer_service_fas.group');
            $topic = Fa::first();
        } elseif ($type === 'MOG') {
            $topic = Mog::first();
        } elseif ($type === 'DOA') {
            $topic = Doa::first();
        } elseif ($type === 'WBI') {
            $topic = Wbi::first();
        } elseif ($type === 'WN') {
            $topic = Wn::first();
        } elseif ($type === 'IBADAH RAYA') {
            $topic = Ir::first();
        } elseif ($type === 'BOOM') {
            $topic = Boom::first();
        } elseif ($type === 'RBI') {
            $topic = Rbi::first();
        }

        $services = $query->get();

        $groups = Group::with('users')
            ->with('leaderUser')
            ->get();

        return view('components.web.service-detail', compact('services', 'topic', 'type', 'groups'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
