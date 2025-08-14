<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Donation;
use App\Models\Qris;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $type)
    {
        $banks = Bank::where('type', $type)->get();
        $qrcodes = Qris::where('type', $type)->get();
        if ($type == 'brc') {
            $donationPurposes = [
                '000' => 'Persembahan',
                '010' => 'Persepuluhan',
                '020' => 'Pembangunan',
                '005' => 'Diakonia/Peduli Kasih',
                '015' => 'Ucapan Syukur',
                '025' => 'HUT/Natal/Paskah',
                '030' => 'Misi',
                '035' => 'Komitmen Videotron',
            ];
        } else {
            $donationPurposes = [
                'sd' => 'SD',
                'smp' => 'SMP',
            ];
        }
        $donations = Donation::with('user')->where('type', $type)->where('is_approved', true)->latest()->paginate(6);

        return view('components.web.donasi', compact('banks', 'qrcodes', 'donationPurposes', 'donations', 'type'));
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
    public function store(Request $request, string $type)
    {
        $data = $request->validate([
            'donor_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'proof_path' => 'required|image|max:2048',
            'purpose' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        $data['type'] = $type;

        // dd($data);
        if ($request->hasFile('proof_path')) {
            $data['proof_path'] = $request->file('proof_path')->store('donation_proof', 'public');
        }

        Donation::create($data);

        return redirect()->route('donasi')->with('success', 'donation_success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
