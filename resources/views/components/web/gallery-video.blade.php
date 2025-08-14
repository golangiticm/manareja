<x-layouts title="gallery video">
    <!-- Page Title -->
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Gallery</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Gallery Video</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="portfolio" class="portfolio section ">

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <div class="row gy-4">
                    <div class="col-lg-4">
                        <div class="sidebar">
                            <div class="search-widget widget-item">
                                <form action="{{ route('gallery-video', ['eventable_type' => $eventable_type]) }}"
                                    method="GET">
                                    <input type="text" name="video_search" placeholder="search..."
                                        value="{{ request('search') }}">
                                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                                </form>
                            </div><!--/Search Widget -->
                            <h5 class="mb-2">Gallery Video Terbaru</h5>
                            <ul class="list-group list-group-flush">
                                @forelse ($VideorecentPosts as $recent)
                                    <li class="list-group-item">
                                        <a href="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($recent->link, 'v=') }}"
                                            class="glightbox">
                                            <strong>{{ Str::limit($recent->title, 50) }}</strong><br>
                                            <small
                                                class="text-muted">{{ $recent->created_at->translatedFormat('d M Y') }}</small>
                                        </a>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center">
                                        <em>Tidak ada Gallery terbaru.</em>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">

                        {{-- <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-service">Service</li>
                            <li data-filter=".filter-program">Program</li>
                        </ul> --}}

                        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                            @forelse ($Videoitems as $item)
                                <div
                                    class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ strtolower($item->eventable_type) }}">
                                    <a href="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($item->link, 'v=') }}"
                                        class="glightbox">
                                        <div class="portfolio-content h-100">
                                            {{-- Thumbnail utama --}}
                                            <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                class="img-fluid rounded-4" alt="{{ $item->title }}">

                                            <div class="portfolio-info">
                                                <h4>{{ $item->title }}</h4>
                                                {{-- Link ke halaman detail (opsional) --}}
                                                <div
                                                    class="pulsating-play-btn position-absolute top-50 start-50 translate-middle">
                                                    {{-- <i class="bi bi-play-circle-fill fs-1 text-white"></i> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <h4 class="text-muted">Tidak ada gallery yang diupload</h4>
                                        <p>Silakan kembali lagi nanti untuk melihat update terbaru.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $Videoitems->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </section><!-- /Portfolio Section -->

    <section id="featured-services" class="featured-services section light-background">

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
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item item-orange position-relative">
                        <div class="icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <a href="/app/bcms" class="stretched-link">
                            <h3>BCM</h3>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item item-teal position-relative">
                        <div class="icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <a href="/app/csrs" class="stretched-link">
                            <h3>CSR</h3>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item item-red position-relative">
                        <div class="icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <a href="/app/kaderisasis" class="stretched-link">
                            <h3>Kaderisasi</h3>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item item-yellow position-relative">
                        <div class="icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <a href="/app/weddings" class="stretched-link">
                            <h3>Wedding</h3>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </section>
</x-layouts>
