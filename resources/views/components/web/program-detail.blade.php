<x-layouts>
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>{{ $type ?? 'Service Details' }}</h1>
            {{-- <p>{{ $service->description ?? 'Detail informasi kegiatan pelayanan' }}</p> --}}
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('program') }}">Service</a></li>
                    <li class="current">{{ $type ?? 'Program Detail' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="program" class="program section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                {{-- untuk deskripsi service --}}
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden" data-aos="fade-up"
                        data-aos-delay="200">
                        <img src="{{ asset($topic && $topic->thumbnail ? 'storage/' . $topic->thumbnail : 'web/img/home/gereja.jpg') }}"
                            alt="{{ $type }}" class="card-img-top img-fluid"
                            style="object-fit: cover; height: 250px;">

                        <div class="card-body">
                            <h3>{{ $type ?? 'Program Description' }}</h3>
                            <p class="card-text text-muted">{!! $topic->description ?? 'No description provided.' !!}</p>
                        </div>
                    </div>
                </div>

                {{-- untuk jadwal --}}
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped bg-white rounded-4 overflow-hidden">
                            <thead class="table-light">
                                <tr>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Title</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Tanggal</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Waktu</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Tempat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($programs as $program)
                                    <tr>
                                        <td>{{ $program->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($program->held_at)->translatedFormat('l, d F Y') }}
                                        </td>
                                        <td>{{ $program->start_time }} - {{ $program->end_time }}</td>
                                        <td>{{ $program->location ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <td colspan="{{ $type == 'FA' ? 7 : 6 }}" style="text-align: center">Belum Ada
                                        Jadwal</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- End Contact Form -->
        </div>
    </section><!-- /Contact Section -->
    <section class="announcements section light-background">
        <div class="container">
            <div class="section-title">
                <h2>Pengumuman Terkait Program</h2>
            </div>
            <div class="row gy-4">

                {{-- Kolom Kiri: Daftar Pengumuman --}}
                <div class="col-lg-12">
                    <div class="row gy-4">
                        @forelse ($programs as $program)
                            @if ($program->announcement)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card h-100 border-0 shadow rounded-4 overflow-hidden">
                                        <div class="ratio ratio-16x9">
                                            <img src="{{ asset('storage/' . $program->announcement->thumbnail) }}"
                                                class="card-img-top object-fit-cover"
                                                alt="{{ $program->announcement->title }}">
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title text-dark fw-semibold">
                                                {{ Str::limit($program->announcement->title, 50) }}
                                            </h5>
                                            <p class="text-muted small mb-2">
                                                <i class="bi bi-calendar-event"></i>
                                                {{ \Carbon\Carbon::parse($program->announcement->published_at)->format('d M Y') }}
                                                &nbsp;
                                                <i class="bi bi-eye"></i> {{ $program->announcement->views }} views
                                            </p>
                                            <p class="card-text text-secondary flex-grow-1">
                                                {{ Str::limit(strip_tags($program->announcement->content), 100, '...') }}
                                            </p>
                                            <div class="text-end">
                                                <button class="btn-get-started" data-bs-toggle="modal"
                                                    data-bs-target="#announcementModal{{ $program->announcement->id }}">
                                                    Selengkapnya
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal --}}
                                <div class="modal fade announcement-modal-brc" id="announcementModal{{ $program->announcement->id }}"
                                    tabindex="-1" aria-labelledby="modalLabel{{ $program->announcement->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $program->announcement->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset('storage/' . $program->announcement->thumbnail) }}"
                                                    class="img-fluid rounded mb-3"
                                                    alt="{{ $program->announcement->title }}">
                                                <p class="text-muted">
                                                    Diterbitkan:
                                                    {{ \Carbon\Carbon::parse($program->announcement->published_at)->format('d M Y') }}
                                                    |
                                                    {{ $program->announcement->views }} views
                                                </p>
                                                <div>{!! $program->announcement->content !!}</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="col-12 text-center">
                                <p class="text-muted">Belum ada pengumuman.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts>
