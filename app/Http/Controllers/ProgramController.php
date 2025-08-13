<?php

namespace App\Http\Controllers;

use App\Models\BaptismPage;
use App\Models\BcmPage;
use App\Models\CsrPage;
use App\Models\KaderisasiPage;
use App\Models\Program;
use App\Models\WeddingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baptism = BaptismPage::first();
        $wedding = WeddingPage::first();
        $csr = CsrPage::first();
        $kaderisasi = KaderisasiPage::first();
        $bcm = BcmPage::first();

        return view('components.web.program', compact('bcm', 'kaderisasi', 'csr', 'wedding', 'baptism'));
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
        $programs = Program::with(['announcement' => function ($q) {
            $q->where('is_publish', true);
        }])->where('type', $type)->whereDate('held_at', '>=', Carbon::today())
            ->orderBy('held_at')->get();

        if ($type === 'BAPTISM') {
            $topic = BaptismPage::first();
        } elseif ($type === 'WEDDING') {
            $topic = WeddingPage::first();
        } elseif ($type === 'CSR') {
            $topic = CsrPage::first();
        } elseif ($type === 'KADERISASI') {
            $topic = KaderisasiPage::first();
        } elseif ($type === 'BCM') {
            $topic = BcmPage::first();
        }
        return view('components.web.program-detail', compact('topic', 'programs', 'type'));
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
