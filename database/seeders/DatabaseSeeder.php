<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\BaptismPage;
use App\Models\BcmPage;
use App\Models\Boom;
use App\Models\CsrPage;
use App\Models\Doa;
use App\Models\Fa;
use App\Models\Home;
use App\Models\Ir;
use App\Models\KaderisasiPage;
use App\Models\Mog;
use App\Models\Rbi;
use App\Models\SettingApp;
use App\Models\User;
use App\Models\Wbi;
use App\Models\WeddingPage;
use App\Models\Wn;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // cari berdasarkan kolom ini
            [
                'name' => 'admin',
                'password' => Hash::make('admin'),
                'is_admin' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'user',
                'password' => Hash::make('user'),
                'is_admin' => false,
            ]
        );


        SettingApp::firstOrCreate([]);
        About::firstOrCreate([]);
        Home::firstOrCreate([], ['kalams' => []]);

        Boom::firstOrCreate([]);
        Fa::firstOrCreate([]);
        Doa::firstOrCreate([]);
        Mog::firstOrCreate([]);
        Rbi::firstOrCreate([]);
        Ir::firstOrCreate([]);
        Wbi::firstOrCreate([]);
        Wn::firstOrCreate([]);

        BaptismPage::firstOrCreate([]);
        WeddingPage::firstOrCreate([]);
        CsrPage::firstOrCreate([]);
        KaderisasiPage::firstOrCreate([]);
        BcmPage::firstOrCreate([]);
    }
}
