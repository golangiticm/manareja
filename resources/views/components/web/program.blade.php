<x-layouts title="Service">
    <!-- Page Title -->
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Program</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Program</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Services Section -->
    <section id="services" class="services section light-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                {{-- ini pengecekan apakah service sudah dibuat belom --}}
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($wedding && $wedding->thumbnail ? 'storage/' . $wedding->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'WEDDING' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('program.show', ['type' => 'WEDDING']) }}">
                                <h3>{{ 'WEDDING' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($csr && $csr->thumbnail ? 'storage/' . $csr->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'CSR' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('program.show', ['type' => 'CSR']) }}">
                                <h3>{{ 'CSR' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($kaderisasi && $kaderisasi->thumbnail ? 'storage/' . $kaderisasi->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'KADERISASI' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('program.show', ['type' => 'KADERISASI']) }}">
                                <h3>{{ 'KADERISASI' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($bcm && $bcm->thumbnail ? 'storage/' . $bcm->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'BCM' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('program.show', ['type' => 'BCM']) }}">
                                <h3>{{ 'BCM' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($baptism && $baptism->thumbnail ? 'storage/' . $baptism->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'BAPTISM' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('program.show', ['type' => 'BAPTISM']) }}">
                                <h3>{{ 'BAPTISM' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
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
