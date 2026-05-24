@extends('user-temp.layout')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Detail Galeri Kegiatan</h1>
                        <p class="mb-0">Dokumentasi Kegiatan TP PKK Kelurahan Cipinang Melayu</p>
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
                    @if ($activity->dokumentasi_list && $activity->dokumentasi_list->isNotEmpty())
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
                                @foreach ($activity->dokumentasi_list as $foto)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $foto->foto) }}" alt="{{ $foto->caption ?? 'Kegiatan' }}">
                                        @if($foto->caption)
                                            <div class="text-center mt-2 fst-italic text-muted">{{ $foto->caption }}</div>
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
                        <h2 class="fw-bold">{{ $activity->nama ?? 'Kegiatan' }}</h2>
                        <span class="badge bg-primary mb-2">{{ $activity->role }}</span>
                        <p class="text-muted mb-2">
                            <i class="bi bi-calendar"></i>
                            {{ \Carbon\Carbon::parse($activity->tanggal_kegiatan)->format('d M Y') }}
                        </p>
                        @if($activity->tempat)
                        <p class="text-muted mb-2">
                            <i class="bi bi-geo-alt"></i> {{ $activity->tempat }}
                        </p>
                        @endif
                        <hr>
                        <p>
                            {!! nl2br(e($activity->uraian ?? 'Tidak ada uraian kegiatan.')) !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Detail Galeri Section -->
@endsection
