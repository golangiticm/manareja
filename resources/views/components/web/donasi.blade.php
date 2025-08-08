<x-layouts title="Donasi">
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Donasi</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Donasi</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="donation-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Dukungan & Donasi</h2>
                <p class="text-muted">Berikan dukungan terbaik Anda untuk pelayanan dan pembangunan gereja.</p>
            </div>

            @if (session('success') === 'donation_success')
                <script>
                    Swal.fire({
                        title: 'Terima Kasih! 🙏',
                        html: `
              <p>Donasi Anda telah berhasil kami terima.</p>
              <p>Semoga Tuhan membalas kebaikan dan kemurahan hati Anda berlipat ganda.</p>
              <p>Terima kasih atas dukungan dan kepercayaannya kepada pelayanan gereja kami.</p>
            `,
                        icon: 'success',
                        confirmButtonText: 'Amin',
                        confirmButtonColor: '#3085d6',
                        customClass: {
                            popup: 'rounded-4 shadow'
                        }
                    });
                </script>
            @endif
            @if ($errors->any())
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let errorList = `
                <ul style="text-align: left;">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </ul>
            `;

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops, ada kesalahan!',
                            html: errorList,
                            confirmButtonText: 'Oke'
                        });
                    });
                </script>
            @endif


            <div class="row gy-4">
                <!-- Info Donasi -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 rounded-4 p-4">
                        <h5 class="mb-3">Informasi Rekening</h5>
                        @if ($banks->isNotEmpty())
                            @foreach ($banks as $bank)
                                <p>
                                    <strong>{{ $bank->nama_bank }}</strong> -
                                    <span class="text-info">{{ $bank->no_rekening }}</span>
                                    a.n. {{ $bank->atas_nama }}
                                </p>
                            @endforeach
                        @endif
                    </div>
                    <div class="card shadow-sm border-0 rounded-4 p-4 mt-2">
                        <h5 class="mb-3">Informasi QRIS</h5>

                        <div class="align-items-center">
                            <div class="portfolio-details-slider swiper init-swiper">
                                <script type="application/json" class="swiper-config">
                                {
                                    "loop": true,
                                    "speed": 600,
                                    "autoplay": {
                                      "delay": 5000
                                    },
                                    "slidesPerView": "auto",
                                    "pagination": {
                                      "el": ".swiper-pagination",
                                      "type": "bullets",
                                      "clickable": true
                                    }
                                }
                            </script>

                                <div class="swiper-wrapper align-items-center mb-2">
                                    @foreach ($qrcodes as $qc)
                                        <div class="swiper-slide text-center">
                                            <img src="{{ asset('storage/' . $qc->qr_code) }}"
                                                alt="QRIS {{ $qc->atas_nama }}" class="img-fluid rounded"
                                                style="max-width: 300px;">
                                            <p class="text-muted mt-2">{{ $qc->atas_nama }}</p>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Optional Pagination & Navigation -->
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Form Donasi -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
                        <h5 class="mb-3">Formulir Donasi</h5>
                        <form method="POST" action="{{ route('donasi.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="donor_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Donasi (Rp)</label>
                                <input type="number" name="amount" class="form-control" min="1000"
                                    max="9999999999.99" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tujuan Donasi</label>
                                <select name="purpose" class="form-select" required>
                                    <option value="">-- Pilih Tujuan --</option>
                                    @foreach ($donationPurposes as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Upload Bukti Transfer</label>
                                <input type="file" name="proof_path" class="form-control" required>
                                @error('proof_path')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pesan / Ucapan</label>
                                <textarea name="message" class="form-control" rows="3"></textarea>
                            </div>
                            <div style="display:flex; justify-content:center; align-items:center">
                                <button type="submit" class="btn-get-started">Kirim Donasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section py-5">
        <div class="container">

            {{-- UCAPAN TERIMA KASIH DI SINI --}}
            <div class="text-center text-white mb-5">
                <h2 class="fw-bold">Terima Kasih untuk Dukungan Anda</h2>
                <p class="text-dark">
                    Donasi Anda sangat berarti bagi pelayanan dan misi gereja.
                    Terima kasih atas kemurahan hati dan kepercayaannya. Tuhan memberkati. 🙏
                </p>
            </div>

            @php
                $purposeNames = [
                    '000' => 'Persembahan',
                    '010' => 'Persepuluhan',
                    '020' => 'Pembangunan',
                    '005' => 'Diakonia/Peduli Kasih',
                    '015' => 'Ucapan Syukur',
                    '025' => 'HUT/Natal/Paskah',
                    '030' => 'Misi',
                    '035' => 'Komitmen Videotron',
                ];
            @endphp

            {{-- TABEL DONATUR --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped bg-white rounded-3 overflow-hidden">
                    <thead class="table-info">
                        <tr>
                            <th>No</th>
                            <th>Nama Donatur</th>
                            <th>Jumlah</th>
                            <th>Tujuan</th>
                            <th>Pesan / Ucapan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                            <tr>
                                <td>{{ ($donations->currentPage() - 1) * $donations->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $donation->donor_name ?? ($donation->user->name ?? '-') }}</td>
                                <td>Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                <td>{{ $purposeNames[$donation->purpose] ?? $donation->purpose }}</td>
                                <td>{{ $donation->message ?? '-' }}</td>
                                <td>{{ $donation->created_at->translatedFormat('d F Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada donasi yang tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $donations->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>

</x-layouts>

<script>
    document.querySelector('input[name="amount"]').addEventListener('input', function() {
        const val = this.value;
        if (val.includes('.')) {
            const [intPart, decPart] = val.split('.');
            if (intPart.length > 10 || decPart.length > 2) {
                this.setCustomValidity('Jumlah maksimal 12 digit dengan 2 desimal.');
            } else {
                this.setCustomValidity('');
            }
        } else {
            if (val.length > 10) {
                this.setCustomValidity('Jumlah maksimal 10 digit.');
            } else {
                this.setCustomValidity('');
            }
        }
    });
</script>
