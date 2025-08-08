<x-layouts title="About">
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>About</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <section id="about" class="about section">

        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset($about && $about->thumbnail ? 'storage/' . $about->thumbnail : 'web/img/home/gereja.jpg') }}"
                        class="img-fluid" alt="Thumbnail" />
                    <a href="{{ $about->link ?? 'https://youtu.be/JxuMZACfcx4?si=lwontyYSEX1luefX' }}"
                        class="glightbox pulsating-play-btn"></a>
                </div>
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Gereja BRC Sanggata</h3>
                    @if (!empty($about?->description))
                        {!! $about->description !!}
                    @else
                        <p>Belum ada deskripsi gan 😂</p>
                    @endif

                </div>
            </div>

        </div>

    </section>
    <section id="vision-mission" class="section light-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="section-title">
                <h2>Visi & Misi</h2>
                <p>Saat ini Gereja Bethany Indonesia-Sangatta, sedang mengemban suatu Misi dan Visi yang diberikan TUHAN
                    sendiri, dan beberapa kali dikonfirmasi beberapa Hamba TUHAN</p>
            </div>
            <div class="accordion accordion-flush" id="accordionVisionMission">

                <!-- Visi -->
                <div class="accordion-item border rounded shadow-sm mb-3">
                    <h2 class="accordion-header" id="headingVisi">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseVisi" aria-expanded="false" aria-controls="collapseVisi">
                            Visi
                        </button>
                    </h2>
                    <div id="collapseVisi" class="accordion-collapse collapse" aria-labelledby="headingVisi"
                        data-bs-parent="#accordionVisionMission">
                        <div class="accordion-body">
                            @if (!empty($about?->visi))
                                {!! $about->visi !!}
                            @else
                                <p>Belum ada visi gan 😂</p>
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Misi -->
                <div class="accordion-item border rounded shadow-sm">
                    <h2 class="accordion-header" id="headingMisi">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseMisi" aria-expanded="false" aria-controls="collapseMisi">
                            Misi
                        </button>
                    </h2>
                    <div id="collapseMisi" class="accordion-collapse collapse" aria-labelledby="headingMisi"
                        data-bs-parent="#accordionVisionMission">
                        <div class="accordion-body">
                            @if (!empty($about?->misi))
                                {!! $about->misi !!}
                            @else
                                <p>Belum ada misi gan 😂</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section id="sejarah" class="section">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center">
                <h2>Sejarah Singkat</h2>
                <p>JEMAAT “BETHANY THE ROYAL CHURCH” SANGATTA</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow rounded-4 overflow-hidden">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div class="portfolio-details-slider swiper init-swiper h-100">

                                    <script type="application/json" class="swiper-config">
                  {
                    "loop": true,
                    "speed": 600,
                    "autoplay": { "delay": 5000 },
                    "slidesPerView": 1,
                    "pagination": {
                      "el": ".swiper-pagination",
                      "type": "bullets",
                      "clickable": true
                    }
                  }
                </script>

                                    <div class="swiper-wrapper h-100">
                                        @if ($about && $about->images && count($about->images))
                                            @foreach ($about->images as $image)
                                                <div class="swiper-slide h-100">
                                                    <img src="{{ asset('storage/' . $image) }}"
                                                        class="img-fluid h-100 w-100 object-fit-cover"
                                                        alt="Foto Sejarah">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="swiper-slide h-100">
                                                <img src="{{ asset('web/img/home/gereja.jpg') }}"
                                                    class="img-fluid h-100 w-100 object-fit-cover"
                                                    alt="Default Foto Sejarah">
                                            </div>
                                        @endif

                                    </div>

                                    <div class="swiper-pagination mt-2"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card-body p-4">
                                    <div class="sejarah-scrollable">
                                        {!! $about?->sejarah !!}
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row g-0 -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="organization-structure" class="section light-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="section-title text-center">
                <h2>Struktur Organisasi</h2>
                <p>Struktur organisasi gereja kami dibangun untuk mendukung pelayanan secara efektif dan terstruktur.
                </p>
            </div>

            @if ($about && !empty($about->avatar_kepala_gembala) && !empty($about->name_kepala_gembala))
                <div class="text-center mb-4">
                    <div class="card d-inline-block shadow-sm">
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $about->avatar_kepala_gembala) }}"
                                alt="{{ $about->name_kepala_gembala }}" class="rounded-circle mb-3" width="100"
                                height="100">
                            <h5 class="card-title">Gembala Jemaat</h5>
                            <p class="card-text">{{ $about->name_kepala_gembala }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($kepalaDivisi) && is_array($kepalaDivisi))
                <div class="row justify-content-center mb-4">
                    @foreach ($kepalaDivisi as $division)
                        @if (!empty($division['avatar']) && !empty($division['name']) && !empty($division['title']))
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('storage/' . $division['avatar']) }}"
                                            alt="{{ $division['name'] }}" class="rounded-circle mb-3" width="100"
                                            height="100">
                                        <h6 class="card-title">{{ $division['title'] }}</h6>
                                        <p class="card-text">{{ $division['name'] }}</p>
                                    </div>
                                </div>

                                @if (!empty($division['dept']) && is_array($division['dept']))
                                    <ul class="list-group mt-2">
                                        @foreach ($division['dept'] as $dept)
                                            @if (!empty($dept['title']) && !empty($dept['name']))
                                                <li class="list-group-item">{{ $dept['title'] }} -
                                                    {{ $dept['name'] }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <p class="text-muted">Belum ada data struktur organisasi.</p>
                </div>
            @endif
            <div class="text-center">
                @if (!empty($about->file))
                    <a href="{{ asset('storage/' . $about->file) }}" class="btn btn-primary" download>
                        Download Struktur Organisasi (PDF)
                    </a>
                @else
                    <p class="text-muted">Belum ada file</p>
                @endif
            </div>
        </div>
    </section>




</x-layouts>
