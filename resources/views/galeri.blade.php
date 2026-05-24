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

    {{-- ================== SECTION GALERI KEGIATAN ================== --}}
    <section id="galeri-kegiatan" class="features section">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Galeri Kegiatan</h2>
                <p>Dokumentasi Kegiatan TP PKK dan Lainnya</p>
            </div>
            <div class="row gy-4">
                @forelse ($kegiatan as $index => $activity)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ 100 + $index * 100 }}">
                        <div class="card border-0 shadow-sm position-relative overflow-hidden rounded-4">
                            {{-- Carousel Foto --}}
                            @if ($activity->dokumentasi_list && $activity->dokumentasi_list->isNotEmpty())
                                <div id="carouselKegiatan{{ $activity->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($activity->dokumentasi_list as $i => $foto)
                                            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $foto->foto) }}"
                                                    class="d-block w-100 img-fluid"
                                                    alt="{{ $foto->caption ?? 'Kegiatan' }}"
                                                    style="height: 350px; object-fit: cover; border-radius: 8px;">
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($activity->dokumentasi_list->count() > 1)
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselKegiatan{{ $activity->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselKegiatan{{ $activity->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    @endif
                                </div>
                            @else
                                <img src="{{ asset('assets-user/img/default.jpg') }}" class="img-fluid"
                                    alt="No Image Available" style="height: 350px; object-fit: cover; border-radius: 8px; width: 100%;">
                            @endif

                            {{-- Overlay Judul --}}
                            <a href="{{ route('galeri.detail', ['id' => $activity->id]) }}"
                                class="stretched-link"></a>
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-3"
                                style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                <h5 class="text-white fw-bold mb-1">{{ \Illuminate\Support\Str::limit($activity->uraian, 50) }}</h5>
                                <div class="text-white-50 small d-flex align-items-center">
                                    <i class="bi bi-calendar me-1"></i>{{ \Carbon\Carbon::parse($activity->tanggal_kegiatan)->format('d M Y') }}
                                    <span class="ms-3 badge bg-primary">{{ $activity->role }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada kegiatan yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
