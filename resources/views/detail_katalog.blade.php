@extends('user-temp.layout')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        {{-- @foreach ($katalog as $katalog) --}}
                        <h1>{{ $katalog->nama_produk }}</h1>
                        <p class="mb-0">{{ $katalog->deskripsi }}.</p>

                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Katalog Details</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper init-swiper">

                        <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 3000
                  },
                  "slidesPerView": "auto",
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>

                        <div class="swiper-wrapper align-katalogs-center">
                            @forelse ($katalog->fotoProduk as $foto)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="{{ $katalog->nama_produk }}">
                                </div>
                            @empty
                                <div class="swiper-slide">
                                    <img src="{{ asset('images/default-product.png') }}" alt="Tidak ada gambar">
                                </div>
                            @endforelse

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                        <h3>Produk Informasi</h3>
                        <ul>
                            <li><strong>Category</strong>: {{ $katalog->kategori }}</li>
                            <li><strong>Penjual</strong>: {{ $katalog->nama_penjual }}</li>
                            <li><strong>Harga</strong>: Rp. {{ number_format($katalog->harga, 0, ',', '.') }},-</li>
                            <li><strong>Stock</strong>: {{ $katalog->stok }}</li>
                            {{-- <li><strong>Klik disini untuk pemesanan</strong>: <a href="#">nomor</a></li> --}}
                        </ul>
                    </div>
                    <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                        <h2>Kunjungi Penjual</h2>
                        <div class="mt-3">

                            @if ($katalog->link_whatsapp)
                                <a href="{{ $katalog->link_whatsapp }}" target="_blank" class="btn btn-outline-success m-1">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                            @endif

                            @if ($katalog->link_instagram)
                                <a href="{{ $katalog->link_instagram }}" target="_blank"
                                    class="btn btn-outline-danger m-1">
                                    <i class="bi bi-instagram"></i> Instagram
                                </a>
                            @endif

                            @if ($katalog->link_tiktok)
                                <a href="{{ $katalog->link_tiktok }}" target="_blank" class="btn btn-outline-dark m-1">
                                    <i class="bi bi-tiktok"></i> TikTok
                                </a>
                            @endif

                            @if ($katalog->link_facebook)
                                <a href="{{ $katalog->link_facebook }}" target="_blank"
                                    class="btn btn-outline-primary m-1">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                            @endif

                            @if ($katalog->link_tokopedia)
                                <a href="{{ $katalog->link_tokopedia }}" target="_blank"
                                    class="btn btn-outline-success m-1">
                                    <i class="bi bi-shop"></i> Tokopedia
                                </a>
                            @endif

                            @if ($katalog->link_shopee)
                                <a href="{{ $katalog->link_shopee }}" target="_blank" class="btn btn-outline-warning m-1">
                                    <i class="bi bi-cart4"></i> Shopee
                                </a>
                            @endif
                            @if (empty($katalog->link_whatsapp) &&
                                    empty($katalog->link_instagram) &&
                                    empty($katalog->link_tiktok) &&
                                    empty($katalog->link_facebook) &&
                                    empty($katalog->link_tokopedia) &&
                                    empty($katalog->link_shopee))
                                <p>Penjual belum menambahkan link sosial media atau e-commerce.</p>
                            @endif

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Portfolio Details Section -->
@endsection
