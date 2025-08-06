<header id="header" class="header d-flex align-items-center fixed-top">
    @php
        $setting = \App\Models\SettingApp::first();
        $logo = $setting && $setting->logo ? asset('storage/' . $setting->logo) : asset('client/img/logo.png');
        $siteName = $setting->site_name ?? config('app.name', 'Nama Situs');
    @endphp
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center gap-2 text-decoration-none">
            <img src="{{ $logo }}" alt="{{ $siteName }}" class="logo-img" />
            <h1 class="sitename m-0">{{ $siteName }}</h1>
        </a>

        <x-layouts.header.nav />
    </div>
</header>
