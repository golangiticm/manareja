<x-layouts title="Home">
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <div id="hero-carousel" class="carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="container position-relative">
                @forelse ($home->kalams as $index => $kalam)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="carousel-container">
                            <h2>{{ $kalam['title'] }}</h2>
                            <p>{!! $kalam['description'] !!}</p>
                            <a href="/app" class="btn-get-started">Join Us</a>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <div class="carousel-container">
                            <h2>Tidak Ada Kalam</h2>
                            <p>Konten belum tersedia.</p>
                        </div>
                    </div>
                @endforelse
                <ol class="carousel-indicators"></ol>
            </div>
        </div>
    </section><!-- /Hero Section -->
    <section id="announcements" class="announcements section light-background">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Pengumuman</h2>
                <p>Informasi terbaru dari gereja</p>
            </div>
            <div class="row">
                @forelse ($announcements as $announcement)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div
                            class="card h-100 border-0 shadow rounded-4 overflow-hidden transition transform hover-shadow">
                            <div class="overflow-hidden" style="max-height: 200px">
                                <img src="{{ asset('storage/' . $announcement->thumbnail) }}"
                                    class="card-img-top object-fit-cover transition scale-on-hover"
                                    alt="{{ $announcement->title }}">
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold text-dark mb-2">{{ $announcement->title }}</h5>
                                <div class="mb-2 text-muted small">
                                    <i class="bi bi-calendar-event"></i>
                                    {{ \Carbon\Carbon::parse($announcement->published_at)->format('d M Y') }} &nbsp;
                                    <i class="bi bi-eye"></i> {{ $announcement->views }} views
                                </div>
                                <p class="card-text text-secondary">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 100, '...') }}
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 text-end px-4 pb-4">
                                <button class="btn-get-started" data-bs-toggle="modal"
                                    data-bs-target="#announcementModal{{ $announcement->id }}">
                                    Selengkapnya
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade announcement-modal-brc" id="announcementModal{{ $announcement->id }}"
                        tabindex="-1" aria-labelledby="modalLabel{{ $announcement->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $announcement->id }}">
                                        {{ $announcement->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset('storage/' . $announcement->thumbnail) }}"
                                        class="img-fluid mb-3" alt="{{ $announcement->title }}">
                                    <p class="text-muted">
                                        Diterbitkan:
                                        {{ \Carbon\Carbon::parse($announcement->published_at)->format('d M Y') }} |
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
                    <div class="col-12">
                        <p class="text-center">Belum ada pengumuman.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('announcements') }}" class="btn-get-started">Lihat Semua Pengumuman</a>
            </div>

        </div>
    </section>
    <section id="featured-services" class="featured-services section">

        <div class="container">
            <div class="section-title">
                <h2>Formulir</h2>
                <p>Formulir Pengajuan</p>
            </div>
            <div class="row gy-4">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item item-cyan position-relative">
                        <div class="icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <a href="/app/baptisms" class="stretched-link">
                            <h3>Baptism</h3>
                        </a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item item-orange position-relative">
                        <div class="icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <a href="/app/bcms" class="stretched-link">
                            <h3>BCM</h3>
                        </a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item item-teal position-relative">
                        <div class="icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <a href="/app/csrs" class="stretched-link">
                            <h3>CSR</h3>
                        </a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item item-red position-relative">
                        <div class="icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <a href="/app/kaderisasis" class="stretched-link">
                            <h3>Kaderisasi</h3>
                        </a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item item-yellow position-relative">
                        <div class="icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <a href="/app/weddings" class="stretched-link">
                            <h3>Wedding</h3>
                        </a>
                    </div>
                </div><!-- End Service Item -->
            </div>

        </div>

    </section><!-- /Featured Services Section -->
    <section id="stats" class="stats section light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{$jemaat}}" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Jemaat Terdaftar</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{$service}}" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Layanan yang Telah Dilaksanakan</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{$program}}" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Program yang Telah Dilaksanakan</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{$donasi}}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Donasi Terkumpul</p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section -->
</x-layouts>
