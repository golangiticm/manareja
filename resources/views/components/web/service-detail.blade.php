<x-layouts>
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>{{ $type ?? 'Service Details' }}</h1>
            {{-- <p>{{ $service->description ?? 'Detail informasi kegiatan pelayanan' }}</p> --}}
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('service') }}">Service</a></li>
                    <li class="current">{{ $type ?? 'Service Detail' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="contact" class="contact section">

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
                            <h3>{{ $type ?? 'Service Description' }}</h3>
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
                                    @if ($type == 'FA')
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Family
                                            Altar</th>
                                    @endif
                                    <th colspan="2" style="text-align: center; vertical-align: middle;">Daftar
                                        Petugas</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">Petugas</th>
                                    <th style="text-align: center; vertical-align: middle;">Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($services as $service)
                                    @php
                                        $assignments = $service->officer_service_assigments;
                                        $rowspan = $assignments->count() > 0 ? $assignments->count() : 1;
                                    @endphp

                                    @if ($assignments->count())
                                        @foreach ($assignments as $index => $assignment)
                                            <tr>
                                                @if ($index === 0)
                                                    <td rowspan="{{ $rowspan }}">{{ $service->title }}</td>
                                                    <td rowspan="{{ $rowspan }}">
                                                        {{ \Carbon\Carbon::parse($service->held_at)->translatedFormat('l, d F Y') }}
                                                    </td>
                                                    <td rowspan="{{ $rowspan }}">{{ $service->start_time }} -
                                                        {{ $service->end_time }}
                                                    </td>
                                                    <td rowspan="{{ $rowspan }}">{{ $service->location ?? '-' }}
                                                    </td>
                                                    @if ($type == 'FA')
                                                        @foreach ($service->officer_service_fas as $fas)
                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $fas->group->name ?? '-' }}</td>
                                                        @endforeach
                                                    @endif
                                                @endif
                                                <td>{{ $assignment->officer->title ?? '-' }}</td>
                                                <td>{{ $assignment->user->name ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>{{ $service->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($service->held_at)->translatedFormat('l, d F Y') }}
                                            </td>
                                            <td>{{ $service->start_time }} - {{ $service->end_time }}</td>
                                            <td>{{ $service->location ?? '-' }}</td>
                                            <td colspan="{{ $type == 'FA' ? 3 : 2 }}" style="text-align: center;">Belum ada petugas</td>
                                        </tr>
                                    @endif
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
    @if ($type == 'FA')
        <section id="featured-services" class="featured-services section light-background">

            <div class="container">
                <div class="section-title">
                    <h2>Family Altar</h2>
                </div>
                <div class="row gy-4">
                    @forelse ($groups as $group)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item item-cyan position-relative">
                                <div class="icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <a href="#" class="stretched-link" data-bs-toggle="modal"
                                    data-bs-target="#groupModal{{ $group->id }}">
                                    <h3>{{ $group->name }}</h3>
                                </a>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="groupModal{{ $group->id }}" tabindex="-1"
                            aria-labelledby="groupModalLabel{{ $group->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="groupModalLabel{{ $group->id }}">Anggota
                                            {{ $group->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($group->users->count())
                                            <ul>
                                                @foreach ($group->users as $user)
                                                    <li>{{ $user->name }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No members in this group.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Belum ada group tersedia.</p>
                    @endforelse
                </div>

            </div>

        </section><!-- /Featured Services Section -->
    @endif
</x-layouts>
