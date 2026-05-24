@extends('user-temp.layout')
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">PKK Cipinang Melayu</h1>
                    <p data-aos="fade-up" data-aos-delay="100">Situs Resmi PKK Kelurahan Cipinang Melayu, Kecamatan Makasar,
                        Jakarta Timur
                    </p>
                    <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                        <a href="#about" class="btn-get-started">Mulai Sekarang <i class="bi bi-arrow-right"></i></a>
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                            class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i
                                class="bi bi-play-circle"></i><span>Nonton Sekarang!</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    @if(isset($carouselImages) && $carouselImages->count() > 0)
                        <!-- Dynamic Premium Hero Carousel -->
                        <div id="heroCarousel" class="carousel slide carousel-fade shadow-lg" data-bs-ride="carousel" data-bs-interval="5000" style="border-radius: 20px; overflow: hidden;">
                            @if($carouselImages->count() > 1)
                                <div class="carousel-indicators">
                                    @foreach($carouselImages as $index => $img)
                                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                            @endif

                            <div class="carousel-inner">
                                @foreach($carouselImages as $index => $img)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $img->foto) }}" class="d-block w-100" style="object-fit: cover; aspect-ratio: 4/3; width: 100%; border-radius: 20px;" alt="Dokumentasi Kegiatan">
                                    </div>
                                @endforeach
                            </div>

                            @if($carouselImages->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    @else
                        <!-- Fallback static hero image -->
                        <img src="{{ asset('assets-user/img/rw12_1.jpg') }}" class="img-fluid animated" onerror="this.onerror=null; this.src='{{ asset('assets-user/img/hero-img.png') }}';" alt="Hero PKK Cipinang Melayu" style="border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    @endif
                </div>
            </div>
        </div>

    </section>
    <!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <h3>TENTANG KAMI</h3>
                        <h2>RW Smart Hub adalah portal digital resmi RW 012 Jatiwaringin, Kota Bekasi.</h2>
                        <p>
                            Website ini dikembangkan untuk meningkatkan partisipasi warga dalam berbagai kegiatan sosial,
                            ekonomi, dan administrasi RW secara lebih cepat, transparan, dan mudah diakses oleh semua
                            lapisan masyarakat.
                            Melalui platform ini, warga dapat memperoleh informasi kegiatan Karang Taruna, promosi produk
                            UMKM binaan PKK, hingga menyampaikan aspirasi secara langsung kepada pengurus RW.

                            Kami percaya bahwa digitalisasi komunitas adalah langkah penting untuk membangun lingkungan yang
                            lebih aktif, inklusif, dan sejahtera.
                        </p>
                        <div class="text-center text-lg-start">
                            <a href="/profil-pkk"
                                class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Lihat Selengkapnya</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                    <img src="assets-user/img/katar12.jpg" class="img-fluid" alt="">
                </div>

            </div>
        </div>
    </section>
    <!-- /About Section -->

    <section id="values" class="values section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <p>LAYANAN<br></p>
            <h2>Yang Kami Sediakan</h2>
            <a href="/layanan" class="readmore stretched-link"><span></span></a>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-4">

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <img src="assets-user/img/values-1.png" class="img-fluid" alt="">
                        <h3>Administrasi Penduduk</h3>
                        <p>Masyarakat bisa melihat berkas apa saja yang diperlukan untuk administrasi.</p>
                        <a href="/layanan" class="readmore stretched-link">
                            <span>Lihat Selengkapnya</span><i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <img src="assets-user/img/values-2.png" class="img-fluid" alt="">
                        <h3>Bank Sampah</h3>
                        <p>Tempat pengelolaan sampah berbasis komunitas yang menukar sampah menjadi nilai ekonomi sekaligus
                            menjaga kebersihan lingkungan.</p>
                        <a href="/layanan" class="readmore stretched-link">
                            <span>Lihat Selengkapnya</span><i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <img src="assets-user/img/values-3.png" class="img-fluid" alt="">
                        <h3>Kampung KB</h3>
                        <p>Program pemberdayaan masyarakat yang berfokus pada peningkatan kualitas hidup keluarga melalui
                            perencanaan, pendidikan, dan kesehatan.</p>
                        <a href="/layanan" class="readmore stretched-link">
                            <span>Lihat Selengkapnya</span><i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div><!-- End Card Item -->

            </div>
        </div>

    </section>
    <!-- /Values Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">
        <div class="container section-title" data-aos="fade-up">
            <p>INFORMASI<br></p>
            <h2>Yang Kami Sediakan</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">

                <div class="col-lg-4 col-md-6">
                    <a href="/katalog" class="text-decoration-none text-dark">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <div>
                                <h3>Katalog <br> Produk</h3>
                                <p>Katalog Produk Penjualan PKK</p>
                            </div>
                        </div>
                    </a>
                </div><!-- End Stats Item -->

                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('kegiatan.akan_datang') }}" class="text-decoration-none text-dark">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <div>
                                <h3>Kegiatan Akan Datang</h3>
                                <p>Jadwal Kegiatan PKK yang akan Datang</p>
                            </div>
                        </div>
                    </a>
                </div><!-- End Stats Item -->

                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('kegiatan.terlaksana') }}" class="text-decoration-none text-dark">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <div>
                                <h3>Kegiatan Terlaksana</h3>
                                <p>Kegiatan PKK yang telah terlaksana</p>
                            </div>
                        </div>
                    </a>
                </div><!-- End Stats Item -->
            </div>
        </div>
    </section>

    <!-- Recent Posts Section -->
    <section id="news" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <p><a href="/galeri" style="color: inherit; text-decoration: none;">GALERI</a></p>
            <h2>Kegiatan Terkini Bulan Ini</h2>
            <a href="/galeri" class="readmore stretched-link"><span></span></a>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row gy-5">
                <div class="row gy-4 posts-list">
                    @forelse ($galeriLanding ?? [] as $item)
                        @php
                            $tanggal = \Carbon\Carbon::parse($item->tanggal_kegiatan);
                            $cover = $item->dokumentasi_list->first();
                        @endphp
                        <div class="col-xl-3 col-md-6">
                            <div class="post-item position-relative h-100 border-0 shadow-sm rounded-4 overflow-hidden" data-aos="fade-up" data-aos-delay="100">

                                <div class="post-img position-relative overflow-hidden" style="height: 200px;">
                                    @if($cover)
                                        <img src="{{ asset('storage/' . $cover->foto) }}"
                                            style="object-fit: cover;" class="img-fluid w-100 h-100" alt="{{ $item->uraian }}">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100 w-100" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                                            <i class="bi bi-image text-white" style="font-size: 2rem;"></i>
                                        </div>
                                    @endif
                                    <span class="post-date" style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.6); color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px;">
                                        {{ $tanggal->format('d M Y') }}
                                    </span>
                                </div>

                                <div class="post-content d-flex flex-column p-3">
                                    <h3 class="post-title fs-5 mb-2 text-truncate" title="{{ $item->uraian }}">{{ $item->uraian }}</h3>

                                    <div class="meta d-flex align-items-center mb-3" style="font-size: 13px;">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person text-primary"></i>
                                            <span class="ps-1">{{ $item->role }}</span>
                                        </div>
                                    </div>

                                    <a href="{{ route('galeri.detail', $item->id) }}" class="readmore mt-auto stretched-link" style="font-size: 14px;">
                                        <span>Lihat Detail</span><i class="bi bi-arrow-right"></i>
                                    </a>

                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Belum ada kegiatan dalam sebulan terakhir.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </section>
    <!-- /Recent Posts Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <p>Partner Kami<br></p>
            <h2>Bekerja sama dengan Instansi Terpercaya</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
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
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><img src="assets-user/img/clients/UNM.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="assets-user/img/clients/kemdi.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="assets-user/img/clients/dikti.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="assets-user/img/clients/berdampak.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="assets-user/img/clients/bem.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="assets-user/img/clients/UNM.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="assets-user/img/clients/kemdi.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="assets-user/img/clients/dikti.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="assets-user/img/clients/berdampak.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="assets-user/img/clients/bem.png" class="img-fluid"
                            alt=""></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section>
    <!-- /Clients Section -->

    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <p>HUBUNGI KAMI</p>
            <h2>Informasi Kontak</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-6">

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="200">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Alamat</h3>
                                <p>Kelurahan Cipinang Melayu</p>
                                <p>Makasar, Jakarta Timur</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="300">
                                <i class="bi bi-telephone"></i>
                                <h3>Call Us</h3>
                                <p>+1 5589 55488 55</p>
                                <p>+1 6678 254445 41</p>
                            </div>
                        </div><!-- End Info Item -->



                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="200">
                                <i class="bi bi-whatsapp"></i>
                                <a href="https://wa.me/6285825017409">
                                    <h3>WhatsApp</h3>
                                </a>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="300">
                                <i class="bi bi-facebook"></i>
                                <a href="https://www.facebook.com/pokjadasawata/">
                                    <h3>Facebook</h3>
                                </a>
                            </div>
                        </div><!-- End Info Item -->
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="400">
                                <i class="bi bi-envelope"></i>
                                <h3>Email Us</h3>
                                <p>info@example.com</p>
                                <p>contact@example.com</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="500">
                                <i class="bi bi-clock"></i>
                                <h3>Open Hours</h3>
                                <p>Monday - Friday</p>
                                <p>9:00AM - 05:00PM</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="400">
                                <i class="bi bi-instagram"></i>
                                <a href="https://www.instagram.com/pokjadasawata/">
                                    <h3>Instagram</h3>
                                </a>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="500">
                                <i class="bi bi-cart"></i>
                                <a href="https://sawataa.com">
                                    <h3>Marketplace</h3>
                                </a>
                            </div>
                        </div><!-- End Info Item -->
                    </div>
                </div>
                <!-- End Contact Form -->

            </div>

            <!-- Section Title -->
    </section>
    <!-- /Contact Section -->

    <section id="contact" class="contact section">
        <div class="container">
            <div class="section-title" data-aos="fade-up" style="margin-top: 50px;">
                <p>LOKASI</p>
                <h2>PKK Cipinang Melayu</h2>
            </div>
            <div class="mb-4" data-aos="fade-up" data-aos-delay="50">

                <iframe style="border:0; width: 100%; height: 400px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.144427794066!2d106.8960106739902!3d-6.2446899937436475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f37d3a86183b%3A0x18ce438310cb437d!2sKantor%20Kelurahan%20Cipinang%20Melayu!5e0!3m2!1sid!2sid!4v1779433448132!5m2!1sid!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection
