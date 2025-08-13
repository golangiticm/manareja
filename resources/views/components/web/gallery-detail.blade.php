<x-layouts>

    <!-- Page Title -->
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>{{ $gallery->title }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('gallery', ['eventable_type' => $gallery->eventable_type]) }}">Galeri Foto</a>
                    </li>
                    <li class="current">{{ $gallery->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Gallery Details Section -->
    <section id="portfolio-details" class="portfolio-details section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">

                <div class="col-lg-4">
                    <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                        <h3>Informasi Galeri</h3>
                        <ul>
                            <li><strong>Event</strong>: {{ $gallery->title }}</li>
                            <li><strong>Tanggal publis</strong>:
                                {{ $gallery->created_at ? $gallery->created_at->translatedFormat('d F Y') : '-' }}
                            </li>
                        </ul>
                    </div>

                    <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                        <h2>Deskripsi</h2>
                        <p>{!! $gallery->description !!}</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                        @foreach ($gallery->images as $image)
                            <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div class="photo-card">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Foto Galeri">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts>
