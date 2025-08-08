<x-layouts>

    {{-- Hero section --}}
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Pengumuman</h1>
            <p>Berikut adalah daftar pengumuman terbaru kami.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Pengumuman</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Section --}}
    <section class="announcements section">
        <div class="container">
            <div class="row gy-4">

                {{-- Kolom Kiri: Daftar Pengumuman --}}
                <div class="col-lg-8">
                    <div class="row gy-4">
                        @forelse ($announcements as $announcement)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow rounded-4 overflow-hidden transition transform hover-shadow">
                                    <div class="ratio ratio-16x9">
                                        <img src="{{ asset('storage/' . $announcement->thumbnail) }}"
                                            class="card-img-top object-fit-cover" alt="{{ $announcement->title }}">
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-dark fw-semibold">
                                            {{ Str::limit($announcement->title, 50) }}
                                        </h5>
                                        <p class="text-muted small mb-2">
                                            <i class="bi bi-calendar-event"></i>
                                            {{ \Carbon\Carbon::parse($announcement->published_at)->format('d M Y') }}
                                            &nbsp;
                                            <i class="bi bi-eye"></i> {{ $announcement->views }} views
                                        </p>
                                        <p class="card-text text-secondary flex-grow-1">
                                            {{ Str::limit(strip_tags($announcement->content), 100, '...') }}
                                        </p>
                                        <div class="text-end">
                                            <button class="btn-get-started"
                                                data-bs-toggle="modal"
                                                data-bs-target="#announcementModal{{ $announcement->id }}">
                                                Selengkapnya
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal --}}
                            <div class="modal fade announcement-modal-brc" id="announcementModal{{ $announcement->id }}"
                                tabindex="-1" aria-labelledby="modalLabel{{ $announcement->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $announcement->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $announcement->thumbnail) }}"
                                                class="img-fluid rounded mb-3" alt="{{ $announcement->title }}">
                                            <p class="text-muted">
                                                Diterbitkan:
                                                {{ \Carbon\Carbon::parse($announcement->published_at)->format('d M Y') }}
                                                |
                                                {{ $announcement->views }} views
                                            </p>
                                            <div>{!! $announcement->content !!}</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p class="text-muted">Belum ada pengumuman.</p>
                            </div>
                        @endforelse

                        <div class="mt-4 d-flex justify-content-center">
                            {{ $announcements->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Sidebar --}}
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="search-widget widget-item">
                            <form action="{{ route('announcements') }}" method="GET">
                                <input type="text" name="search" placeholder="search..."
                                    value="{{ request('search') }}">
                                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!--/Search Widget -->
                        <h5 class="mb-2">Pengumuman Terbaru</h5>
                        <ul class="list-group list-group-flush">
                            @forelse ($recentPosts as $recent)
                                <li class="list-group-item">
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#announcementModal{{ $recent->id }}">
                                        <strong>{{ Str::limit($recent->title, 50) }}</strong><br>
                                        <small
                                            class="text-muted">{{ $recent->created_at->translatedFormat('d M Y') }}</small>
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item text-center">
                                    <em>Tidak ada pengumuman terbaru.</em>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-layouts>
