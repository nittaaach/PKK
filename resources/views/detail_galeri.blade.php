@extends('user-temp.layout')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Detail Galeri {{ strtoupper($type) }}</h1>
                        <p class="mb-0">Kegiatan {{ $type === 'pkk' ? 'PKK' : 'Karang Taruna' }} RW 12</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li><a href="{{ route('galeri') }}">Galeri</a></li>
                    <li class="current">Detail Galeri</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Detail Galeri Section -->
    <section id="portfolio-details" class="portfolio-details section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">
                {{-- ================= Gambar / Carousel ================= --}}
                <div class="col-lg-8">
                    @if ($activity->dokumentasi && $activity->dokumentasi->isNotEmpty())
                        <div class="portfolio-details-slider swiper init-swiper">
                            <script type="application/json" class="swiper-config">
                                {
                                  "loop": true,
                                  "speed": 600,
                                  "autoplay": { "delay": 5000 },
                                  "slidesPerView": "auto",
                                  "pagination": {
                                    "el": ".swiper-pagination",
                                    "type": "bullets",
                                    "clickable": true
                                  }
                                }
                            </script>

                            <div class="swiper-wrapper align-items-center">
                                @foreach ($activity->dokumentasi as $foto)
                                    <div class="swiper-slide">
                                        @if ($type === 'pkk')
                                            <img src="{{ asset('storage/' . $foto->fotopkk) }}"
                                                alt="{{ $foto->caption ?? $activity->judul }}">
                                        @else
                                            <img src="{{ asset('storage/' . $foto->fotokatar) }}"
                                                alt="{{ $foto->caption ?? $activity->judul }}">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    @else
                        <img src="{{ asset('assets-user/img/default.jpg') }}" class="img-fluid rounded-3"
                            alt="No Image Available">
                    @endif
                </div>

                {{-- ================= Deskripsi ================= --}}
                <div class="col-lg-4">
                    <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="fw-bold">{{ $activity->judul }}</h2>
                        <p class="text-muted mb-2">
                            <i class="bi bi-calendar"></i>
                            {{ \Carbon\Carbon::parse($activity->tanggal_acara)->format('d M Y, H:i') }}
                        </p>
                        <hr>
                        <p>
                            {{ $activity->deskripsi ?? 'Tidak ada deskripsi untuk kegiatan ini.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Detail Galeri Section -->
@endsection
