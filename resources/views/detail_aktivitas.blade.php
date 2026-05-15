@extends('user-temp.layout')
@section('content')

    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Detail Aktivitas</h1>
                        <p class="mb-0">
                            @if ($type === 'pkk')
                                Temukan aktivitas yang berada di PKK RW 12
                            @else
                                Temukan aktivitas yang berada di Karang Taruna RW 12
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li><a href="{{ route('aktivitas') }}">Aktivitas</a></li>
                    <li class="current">Detail Aktivitas</li>
                </ol>
            </div>
        </nav>
    </div>
    <!-- End Page Title -->

    <!-- ======= Detail Aktivitas Section ======= -->
    <section id="portfolio-details" class="portfolio-details section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">

                <!-- Bagian Kiri: Carousel Foto -->
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper init-swiper">

                        {{-- Konfigurasi Swiper --}}
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
                            {{-- Jika ada dokumentasi foto --}}
                            @if ($activity->dokumentasi && $activity->dokumentasi->isNotEmpty())
                                @foreach ($activity->dokumentasi as $foto)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . ($type === 'pkk' ? $foto->fotopkk : $foto->fotokatar)) }}"
                                            alt="{{ $foto->caption ?? $activity->judul }}" class="img-fluid"
                                            style="width:100%; height:400px; object-fit:cover; border-radius:10px;">
                                    </div>
                                @endforeach
                            @else
                                {{-- Gambar default kalau tidak ada --}}
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets-user/img/blog/default.jpg') }}" alt="Default Image"
                                        class="img-fluid"
                                        style="width:100%; height:400px; object-fit:cover; border-radius:10px;">
                                </div>
                            @endif
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- Bagian Kanan: Info Aktivitas -->
                <div class="col-lg-4">
                    <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                        <h3>Informasi Aktivitas</h3>
                        <ul>
                            <li><strong>Kategori</strong>: {{ strtoupper($type) }}</li>
                            <li><strong>Lokasi</strong>: {{ $activity->lokasi ?? 'Umum' }}</li>
                            <li><strong>Tanggal Acara</strong>:
                                {{ \Carbon\Carbon::parse($activity->tanggal_acara)->format('d M Y, H:i') }}
                            </li>
                            <li><strong>Penyelenggara</strong>: {{ $activity->penyelenggara ?? 'Admin' }}</li>
                            @if ($activity->link)
                                <li><strong>Link Terkait</strong>:
                                    <a href="{{ $activity->link }}" target="_blank">{{ $activity->link }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                        <h2>{{ $activity->judul }}</h2>
                        <p>{!! nl2br(e($activity->deskripsi)) !!}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /Detail Aktivitas Section -->

@endsection
