<x-layouts title="Kontak">
    <!-- Page Title -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Terima Kasih!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Contact</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Contact</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">
                <!-- Info Kontak -->
                <div class="col-lg-6">
                    <div class="row gy-4">

                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 p-3 shadow-sm rounded bg-white">
                                <div>
                                    <i class="bi bi-geo-alt-fill fs-3 text-primary"></i>
                                </div>
                                <div>
                                    @if ($contact && $contact->address)
                                        <p class="mb-0 small">{{ $contact->address }}</p>
                                    @else
                                        <p class="mb-0 small text-muted">Belum ada alamat yang ditambahkan</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="d-flex align-items-center gap-3 p-3 shadow-sm rounded bg-white">
                                <i class="bi bi-telephone-fill fs-3 text-success"></i>
                                <div>
                                    @if (!empty($contact->phones) && is_array($contact->phones))
                                        <table class="table table-borderless mb-0 small">
                                            <tbody>
                                                @foreach ($contact->phones as $phone)
                                                    <tr>
                                                        <td class="fw-bold">{{ $phone['atas_nama'] ?? '-' }}</td>
                                                        <td>: {{ $phone['number'] ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="mb-0 small text-muted">Belum ada kontak telepon</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex align-items-center gap-3 p-3 shadow-sm rounded bg-white">
                                <i class="bi bi-envelope-fill fs-3 text-danger"></i>
                                <div>
                                    @if (!empty($contact->emails) && is_array($contact->emails))
                                        <table class="table table-borderless mb-0 small">
                                            <tbody>
                                                @foreach ($contact->emails as $email)
                                                    <tr>
                                                        <td class="fw-bold">{{ $email['atas_nama'] ?? '-' }}</td>
                                                        <td>: {{ $email['email'] ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="mb-0 small text-muted">Belum ada kontak telepon</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Kontak -->
                <div class="col-lg-6">
                    <form action="{{ route('contact.store') }}" method="POST"
                        class="contact-form p-4 rounded shadow-sm bg-white">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Nama Anda"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email Anda"
                                    required>
                            </div>

                            <div class="col-12">
                                <input type="text" name="subject" class="form-control" placeholder="Subject"
                                    required>
                            </div>

                            <div class="col-12">
                                <textarea name="message" class="form-control" rows="5" placeholder="Pesan Anda" required></textarea>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn-get-started px-4 py-2 rounded-pill">Kirim
                                    Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div><!-- End Contact Form -->

        </div>

        <div class="mt-5" data-aos="fade-up" data-aos-delay="200">
            <iframe style="border:0; width: 100%; height: 370px;"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d249.35428041089878!2d117.5314818855699!3d0.4965549104682698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x320a35064a07356b%3A0xe54f459c88f7f4f!2sGereja%20Bethany%20Indonesia%20Jemaat%20Sangatta!5e0!3m2!1sid!2sid!4v1753175442299!5m2!1sid!2sid"
                frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->

    </section><!-- /Contact Section -->
    </x-client.layouts>
