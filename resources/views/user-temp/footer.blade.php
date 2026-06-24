@yield('footer')
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="container footer-top">
        <div class="row gy-4">

            <!-- Tentang -->
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="{{ route('landing') }}" class="d-flex align-items-center">
                    <span class="sitename">PKK Cipinang Melayu</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>RW 12 Jatiwaringin</p>
                    <p>Jakarta Timur, Indonesia</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>+62 812-3456-7890</span></p>
                    <p><strong>Email:</strong> <span>info@PKK Cipinang Melayu.id</span></p>
                </div>
            </div>

            <!-- Navigasi Utama -->
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Menu</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('landing') }}">Beranda</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('profil') }}">Profil PKK</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('informasi') }}">Informasi</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('galeri') }}">Galeri</a></li>
                </ul>
            </div>

            <!-- Informasi -->
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Informasi</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('kegiatan.akan_datang') }}">Kegiatan Akan Datang</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('kegiatan.terlaksana') }}">Kegiatan Terlaksana</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('katalog') }}">Katalog</a></li>
                </ul>
            </div>

            <!-- Media Sosial -->
            <div class="col-lg-4 col-md-12">
                <h4>Ikuti Kami</h4>
                <p>Terhubung dengan kami untuk informasi dan kegiatan terbaru di lingkungan RW 12.</p>
                <div class="social-links d-flex">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/pkk_kel_cipinang_melayu/"><i class="bi bi-instagram"></i></a>
                    <a href="https://maps.app.goo.gl/QBQwKET339r3LTuL8"><i class="bi bi-pin-map"></i></a>
                </div>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>2025</span> <strong class="px-1 sitename">PKK Cipinang Melayu</strong> <span>All Rights
                Reserved</span></p>
    </div>
</footer>
<!-- End Footer -->

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

<!-- ======= Vendor JS Files ======= -->
<script src="{{ asset('assets-user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets-user/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets-user/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets-user/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets-user/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets-user/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets-user/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets-user/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- ======= Main JS File (penting agar menu titik tiga berfungsi) ======= -->
<script src="{{ asset('assets-user/js/main.js') }}"></script>
