<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center gap-2 text-decoration-none">
            <img src="{{ asset($setting && $setting->logo ? 'storage/' . $setting->logo : 'images/favicon.png') }}" alt="{{ $setting->site_name }}" class="logo-img" />
            <h1 class="sitename m-0">{{ $setting->site_name }}</h1>
        </a>

        <x-layouts.header.nav />
    </div>
</header>
