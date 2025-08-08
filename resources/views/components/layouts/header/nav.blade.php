<nav id="navmenu" class="navmenu">
    <ul>
        <li>
            <x-layouts.header.link href="{{ route('home') }}">
                Home
            </x-layouts.header.link>
        </li>
        <li>
            <x-layouts.header.link href="{{ route('about') }}">
                About
            </x-layouts.header.link>
        </li>
        <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                @foreach ($serviceMenu as $item)
                    <li>
                        <x-layouts.header.link href="#">
                            {{-- <x-layouts.header.link href="{{ route('galleries.index') }}"> --}}
                            {{ $item }}
                        </x-layouts.header.link>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="dropdown"><a href="#"><span>Programs</span> <i
                    class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                @foreach ($programMenu as $item)
                    <li>
                        <x-layouts.header.link href="#">
                            {{-- <x-layouts.header.link href="{{ route('galleries.index') }}"> --}}
                            {{ $item }}
                        </x-layouts.header.link>
                    </li>
                @endforeach

            </ul>
        </li>
        <li class="dropdown"><a href="#"><span>Gallery</span> <i
                    class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li>
                    <x-layouts.header.link href="#">
                        {{-- <x-layouts.header.link href="{{ route('galleries.index') }}"> --}}
                        Foto
                    </x-layouts.header.link>
                </li>
                <li>
                    <x-layouts.header.link href="#">
                        {{-- <x-layouts.header.link href="{{ route('galleryvideos.index') }}"> --}}
                        Video
                    </x-layouts.header.link>
                </li>
            </ul>
        </li>
        <li>
            <x-layouts.header.link href="{{ route('cabang') }}">
                Cabang
            </x-layouts.header.link>
        </li>
        <li>
            <x-layouts.header.link href="{{ route('donasi') }}">
                Donation
            </x-layouts.header.link>
        </li>
        <li>
            <x-layouts.header.link href="{{ route('contact') }}">
                Contact
            </x-layouts.header.link>
        </li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>
