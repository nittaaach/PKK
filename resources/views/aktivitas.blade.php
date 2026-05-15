@extends('user-temp.layout')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Aktivitas</h1>
                        <p class="mb-0">Informasi Terkini</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Berita</li>
                    <li class="current">Aktivitas</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- ======= Aktivitas PKK Section ======= -->
    <section id="aktivitas-pkk" class="recent-posts section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <p>Aktivitas PKK</p>
                <h2>Kegiatan terbaru dari h2KK</h2>
            </div>

            <div class="row gy-5">
                @forelse ($activities as $activity)
                    <div class="col-xl-4 col-md-6">
                        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                            <div class="post-img position-relative overflow-hidden">
                                @if ($activity->dokumentasi && $activity->dokumentasi->isNotEmpty())
                                    <div id="carouselPkk{{ $activity->id }}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($activity->dokumentasi as $index => $foto)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $foto->fotopkk) }}"
                                                        class="d-block w-100 img-fluid"
                                                        alt="{{ $foto->caption ?? $activity->judul }}"
                                                        style="height: 250px; object-fit: cover; border-radius: 8px;">
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($activity->dokumentasi->count() > 1)
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselPkk{{ $activity->id }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselPkk{{ $activity->id }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <img src="{{ asset('assets-user/img/blog/default.jpg') }}" class="img-fluid"
                                        alt="{{ $activity->judul }}">
                                @endif

                                <span class="post-date">
                                    {{ optional($activity->tanggal_acara)->format('d M Y, H:i') }}
                                </span>
                            </div>

                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $activity->judul }}</h3>

                                <div class="meta d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person"></i>
                                        <span class="ps-2">{{ $activity->penyelenggara }}</span>
                                    </div>
                                    <span class="px-3 text-black-50">/</span>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-folder2"></i>
                                        <span class="ps-2">{{ $activity->kategori }}</span>
                                    </div>
                                </div>

                                <hr>

                                <a href="{{ route('detail.aktivitas', ['type' => 'pkk', 'id' => $activity->id]) }}">
                                    <span>Read More</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>

                        </div>
                    </div><!-- End post item -->
                @empty
                    <p class="text-center">Belum ada aktivitas PKK yang dipublikasikan.</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- /Aktivitas PKK Section -->


    <!-- ======= Aktivitas Karang Taruna Section ======= -->
    <section id="aktivitas-katar" class="recent-posts section bg-light">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <p>Aktivitas Karang Taruna</p>
                <h2>Kegiatan terbaru dari Karang Taruna</h2>
            </div>

            <div class="row gy-5">
                @forelse ($activities as $activity)
                    <div class="col-xl-4 col-md-6">
                        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                            <div class="post-img position-relative overflow-hidden">
                                @if ($activity->dokumentasi && $activity->dokumentasi->isNotEmpty())
                                    <div id="carouselKatar{{ $activity->id }}" class="carousel slide"
                                        data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($activity->dokumentasi as $index => $foto)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $foto->fotokatar) }}"
                                                        class="d-block w-100 img-fluid"
                                                        alt="{{ $foto->caption ?? $activity->judul }}"
                                                        style="height: 250px; object-fit: cover; border-radius: 8px;">
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($activity->dokumentasi->count() > 1)
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselKatar{{ $activity->id }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselKatar{{ $activity->id }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <img src="{{ asset('assets-user/img/blog/default.jpg') }}" class="img-fluid"
                                        alt="{{ $activity->judul }}">
                                @endif

                                <span class="post-date">
                                    {{ optional($activity->tanggal_acara)->format('d M Y, H:i') }}
                                </span>
                            </div>

                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $activity->judul }}</h3>

                                <div class="meta d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person"></i>
                                        <span class="ps-2">{{ $activity->penyelenggara }}</span>
                                    </div>
                                    <span class="px-3 text-black-50">/</span>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-folder2"></i>
                                        <span class="ps-2">{{ $activity->kategori }}</span>
                                    </div>
                                </div>

                                <hr>

                                <a href="{{ route('detail.aktivitas', ['type' => 'katar', 'id' => $activity->id]) }}">
                                    <span>Read More</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>

                        </div>
                    </div><!-- End post item -->
                @empty
                    <p class="text-center">Belum ada aktivitas Karang Taruna yang dipublikasikan.</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- /Aktivitas Karang Taruna Section -->
@endsection
