<footer id="footer" class="footer dark-background">
    @php
        $setting = \App\Models\SettingApp::first();
    @endphp
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="{{ url('/') }}" class="d-flex align-items-center">
                    <span class="sitename">{{ $setting->site_name }}</span>
                </a>
                <div class="footer-contact pt-3">
                    {{ $setting->address }}
                    <p class="mt-3"><strong>Phone:</strong>
                        <span>{{ $setting->phones[0]['number'] ?? 'Belum ada phone terdaftar' }}</span>
                    </p>
                    <p><strong>Email:</strong>
                        <span>{{ $setting->emails[0]['email'] ?? 'Belum ada email terdaftar' }}</span></p>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">

            </div>


            <div class="col-lg-4 col-md-12">
                <h4>Follow Us</h4>
                <p></p>
                <div class="social-links d-flex">
                    <a href="https://www.youtube.com/@brcsangatta6642"><i class="bi bi-youtube"></i></a>
                    <a href="https://www.facebook.com/betesda.sangatta.3?locale=id_ID"><i
                            class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/brc.sangatta/?igsh=MWhtcWZlZmtybHQyZw%3D%3D#"><i
                            class="bi bi-instagram"></i></a>
                    <a href="https://www.facebook.com/boom.sangatta?locale=id_ID"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/boom.brc?igsh=ZnM3Nmg2NHE0ZjN5"><i
                            class="bi bi-instagram"></i></a>
                </div>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Manareja</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            Designed by <a href="https://www.bitmatic.co.id">BITMATIC</a>
        </div>
    </div>

</footer>
