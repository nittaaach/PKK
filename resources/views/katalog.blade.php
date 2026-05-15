@extends('user-temp.layout')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Katalog PKK</h1>
                        <p class="mb-0">Produk UMKM RW 12</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Informasi</li>
                    <li class="current">Katalog PKK</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">
        <div class="container">
            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    @foreach ($all_categories as $kategori_nama)
                        <li data-filter=".filter-{{ Str::slug($kategori_nama) }}">{{ $kategori_nama }}</li>
                    @endforeach
                </ul>

                {{-- 
              MASALAH 1: Hapus <div class="row"> yang ganda. 
              Cukup SATU baris ini untuk membungkus loop.
            --}}
                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                    {{-- HAPUS: <div class="row gy-4 isotope-container" ...> yang ada di sini --}}

                    @foreach ($katalog as $item)
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ Str::slug($item->kategori) }}">

                            <div class="portfolio-content">
                                <div id="produkCarousel-{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @forelse ($item->fotoProduk as $foto)
                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $foto->path_foto) }}" class="img-fluid"
                                                    {{-- MASALAH 2: Ganti style kaku ke responsif --}}
                                                    style="width: 100%; aspect-ratio: 1 / 1; object-fit: cover;"
                                                    alt="{{ $item->nama_produk }}">
                                            </div>
                                        @empty
                                            <div class="carousel-item active">
                                                <img src="{{ asset('images/default-product.png') }}" class="img-fluid"
                                                    {{-- MASALAH 2: Ganti style kaku ke responsif --}}
                                                    style="width: 100%; aspect-ratio: 1 / 1; object-fit: cover;"
                                                    alt="Tidak ada gambar">
                                            </div>
                                        @endforelse
                                    </div>
                                    @if ($item->fotoProduk->count() > 1)
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#produkCarousel-{{ $item->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#produkCarousel-{{ $item->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    @endif
                                </div>
                                <div class="portfolio-info">
                                    <h4>{{ $item->nama_produk }}</h4>
                                    <p>Rp. {{ number_format($item->harga, 0, ',', '.') }},- / {{ $item->kategori }}</p>
                                    @if ($item->fotoProduk && $item->fotoProduk->isNotEmpty())
                                        @php
                                            $fotoPertama = $item->fotoProduk->first();
                                        @endphp
                                        <a href="{{ asset('storage/' . $fotoPertama->path_foto) }}"
                                            title="{{ $item->nama_produk }}"
                                            data-gallery="portfolio-gallery-{{ $item->id }}"
                                            class="glightbox preview-link">
                                            <i class="bi bi-zoom-in"></i>
                                        </a>
                                        @foreach ($item->fotoProduk->skip(1) as $foto)
                                            <a href="{{ asset('storage/' . $foto->path_foto) }}"
                                                title="{{ $item->nama_produk }}"
                                                data-gallery="portfolio-gallery-{{ $item->id }}"
                                                class="glightbox preview-link" style="display: none;"></a>
                                        @endforeach
                                    @else
                                        <a href="{{ asset('images/default-product.png') }}"
                                            title="{{ $item->nama_produk }}"
                                            data-gallery="portfolio-gallery-{{ $item->id }}"
                                            class="glightbox preview-link">
                                            <i class="bi bi-zoom-in"></i>
                                        </a>
                                    @endif
                                    <a href="/detail_katalog/{{ $item->id }}" title="More Details"
                                        class="details-link">
                                        <i class="bi bi-link-45deg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>{{-- Komentar ini dipindah ke sini --}}
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
