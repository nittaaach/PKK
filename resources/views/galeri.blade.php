@extends('user-temp.layout')


@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Galeri</h1>
                        <p class="mb-0">Memori RW 12</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Informasi</li>
                    <li class="current">Galeri</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    {{-- ================== SECTION PKK ================== --}}
    <section id="galeri-pkk" class="features section">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Kegiatan PKK</h2>
                <p>Dokumentasi kegiatan PKK RW 12</p>
            </div>
            <div class="row gy-4">
                @forelse ($pkkActivities as $index => $activity)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ 100 + $index * 100 }}">
                        <div class="card border-0 shadow-sm position-relative overflow-hidden rounded-4">
                            {{-- Carousel Foto --}}
                            @if ($activity->dokumentasi && $activity->dokumentasi->isNotEmpty())
                                <div id="carouselPKK{{ $activity->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($activity->dokumentasi as $i => $foto)
                                            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $foto->fotopkk) }}"
                                                    class="d-block w-100 img-fluid"
                                                    alt="{{ $foto->caption ?? $activity->judul }}"
                                                    style="height: 350px; object-fit: cover; border-radius: 8px;">
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($activity->dokumentasi->count() > 1)
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselPKK{{ $activity->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselPKK{{ $activity->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    @endif
                                </div>
                            @else
                                <img src="{{ asset('assets-user/img/default.jpg') }}" class="img-fluid"
                                    alt="No Image Available">
                            @endif

                            {{-- Overlay Judul --}}
                            <a href="{{ route('galeri.detail', ['id' => $activity->id, 'type' => 'pkk']) }}"
                                class="stretched-link"></a>
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-3"
                                style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                <h5 class="text-white fw-bold mb-1">{{ $activity->judul }}</h5>
                                <div class="text-white-50 small d-flex align-items-center">
                                    <i
                                        class="bi bi-calendar me-1"></i>{{ \Carbon\Carbon::parse($activity->tanggal_acara)->format('d M Y, H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada kegiatan PKK yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ================== SECTION KARANG TARUNA ================== --}}
    <section id="galeri-katar" class="features section bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Kegiatan Karang Taruna</h2>
                <p>Dokumentasi Kegiatan Karang Taruna RW 12</p>
            </div>
            <div class="row gy-4">
                @forelse ($katarActivities as $index => $activity)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ 100 + $index * 100 }}">
                        <div class="card border-0 shadow-sm position-relative overflow-hidden rounded-4">
                            {{-- Carousel Foto --}}
                            @if ($activity->dokumentasi && $activity->dokumentasi->isNotEmpty())
                                <div id="carouselKatar{{ $activity->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($activity->dokumentasi as $i => $foto)
                                            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $foto->fotokatar) }}"
                                                    class="d-block w-100 img-fluid"
                                                    alt="{{ $foto->caption ?? $activity->judul }}"
                                                    style="height: 350px; object-fit: cover; border-radius: 8px;">
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
                                <img src="{{ asset('assets-user/img/default.jpg') }}" class="img-fluid"
                                    alt="No Image Available">
                            @endif

                            {{-- Overlay Judul --}}
                            <a href="{{ route('galeri.detail', ['id' => $activity->id, 'type' => 'katar']) }}"
                                class="stretched-link"></a>
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-3"
                                style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                <h5 class="text-white fw-bold mb-1">{{ $activity->judul }}</h5>
                                <div class="text-white-50 small d-flex align-items-center">
                                    <i
                                        class="bi bi-calendar me-1"></i>{{ \Carbon\Carbon::parse($activity->tanggal_acara)->format('d M Y, H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada kegiatan Karang Taruna yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
