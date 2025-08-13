<x-layouts title="Service">
    <!-- Page Title -->
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Service</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Service</li>
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
                            <img src="{{ asset($boom && $boom->thumbnail ? 'storage/' . $boom->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'BOOM' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('service.show', ['type' => 'BOOM']) }}">
                                <h3>{{ 'BOOM' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($doa && $doa->thumbnail ? 'storage/' . $doa->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'DOA' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('service.show', ['type' => 'DOA']) }}">
                                <h3>{{ 'DOA' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($fa && $fa->thumbnail ? 'storage/' . $fa->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'Familiy Altar' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('service.show', ['type' => 'FA']) }}">
                                <h3>{{ 'Familiy Altar' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($mog && $mog->thumbnail ? 'storage/' . $mog->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'MOG' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('service.show', ['type' => 'MOG']) }}">
                                <h3>{{ 'MOG' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($rbi && $rbi->thumbnail ? 'storage/' . $rbi->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'RBI' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('service.show', ['type' => 'RBI']) }}">
                                <h3>{{ 'RBI' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($ir && $ir->thumbnail ? 'storage/' . $ir->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'Ibadah Raya' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('service.show', ['type' => 'IBADAH RAYA']) }}">
                                <h3>{{ 'Ibadah Raya' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($wbi && $wbi->thumbnail ? 'storage/' . $wbi->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'WBI' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('service.show', ['type' => 'WBI']) }}">
                                <h3>{{ 'WBI' }}</h3>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="img">
                            <img src="{{ asset($wn && $wn->thumbnail ? 'storage/' . $wn->thumbnail : 'web/img/home/gereja.jpg') }}"
                                class="img-fluid" alt="{{ 'WN' }}">
                        </div>
                        <div class="details">
                            <a href="{{ route('service.show', ['type' => 'WN']) }}">
                                <h3>{{ 'WN' }}</h3>
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
