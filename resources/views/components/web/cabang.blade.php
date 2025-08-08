<x-layouts title="Cabang">
    <!-- Page Title -->
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Cabang</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Cabang</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Services Section -->
    <section id="services" class="services section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                @forelse($cabangs as $cabang)
                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="img">
                                <img src="{{ asset('storage/' . $cabang->thumbnail) }}" class="img-fluid"
                                    alt="{{ $cabang->name }}">
                            </div>
                            <div class="details">
                                <h3>{{ $cabang->name }}</h3>
                                <p><strong>Alamat:</strong> {{ $cabang->address }}</p>
                                <p><strong>Telepon:</strong> {{ $cabang->telephone }}</p>
                                <p><strong>Email:</strong> <a
                                        href="mailto:{{ $cabang->email }}">{{ $cabang->email }}</a></p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->
                @empty
                    <div class="col-12 my-96" style="margin: 100px auto !important;">
                        <p class="text-center">Belum ada cabang yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section><!-- /Services Section -->
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
</x-layouts>
