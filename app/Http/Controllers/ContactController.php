<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\ContactMessageMail;
use App\Models\Email;
use App\Models\SettingApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = SettingApp::first();
        return view('components.web.contact', compact('contact'));
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
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Simpan ke database
        Email::create($validated);

        $setting = SettingApp::first();

        // Pastikan ada isinya dan dalam bentuk array
        // Cek apakah sudah ada email admin
        if (!$setting || !is_array($setting->emails) || count($setting->emails) === 0) {
            return back()->with('error', 'Belum tersedia inisialisasi mail instansi. Mohon tunggu beberapa saat.');
        }

        $firstEmail = $setting->emails[0]['email'] ?? null;
        // Kirim email ke admin
        Mail::to($firstEmail)->send(new ContactMessageMail($validated));

        return back()->with('success', 'Pesan Anda berhasil dikirim.');
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
