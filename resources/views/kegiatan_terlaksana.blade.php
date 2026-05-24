@extends('user-temp.layout')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Kegiatan Terlaksana</h1>
                        <p class="mb-0">Rekam Jejak Kegiatan TP PKK Kelurahan Cipinang Melayu</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('landing') }}">Home</a></li>
                    <li class="current">Kegiatan</li>
                    <li class="current">Terlaksana</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <section class="section py-5">
        <div class="container">

            {{-- Filter Role --}}
            <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
                <a href="{{ route('kegiatan.terlaksana') }}"
                    class="btn {{ !request('role') ? 'btn-success' : 'btn-outline-success' }} rounded-pill px-4">
                    Semua
                </a>
                @foreach(['Sekretaris', 'Pokja_1', 'Pokja_2', 'Pokja_3', 'Pokja_4'] as $r)
                <a href="{{ route('kegiatan.terlaksana', ['role' => $r]) }}"
                    class="btn {{ request('role') == $r ? 'btn-success' : 'btn-outline-success' }} rounded-pill px-4">
                    {{ str_replace('_', ' ', $r) }}
                </a>
                @endforeach
            </div>

            @if($kegiatan->isEmpty())
                <div class="text-center py-5">
                    <div style="font-size: 5rem; color: #ccc;"><i class="bi bi-journal-x"></i></div>
                    <h4 class="text-muted mt-3">Belum ada kegiatan yang tercatat</h4>
                    <p class="text-muted">Kegiatan yang sudah berlangsung akan ditampilkan di sini.</p>
                </div>
            @else
                {{-- Stats Summary --}}
                <div class="row g-3 mb-5">
                    <div class="col-md-4">
                        <div class="card border-0 text-center p-3 rounded-4" style="background: linear-gradient(135deg, #11998e, #38ef7d);">
                            <div class="text-white">
                                <div style="font-size: 2rem; font-weight: 700;">{{ $kegiatan->total() }}</div>
                                <div class="small opacity-75">Total Kegiatan Terlaksana</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 text-center p-3 rounded-4" style="background: linear-gradient(135deg, #4776e6, #8e54e9);">
                            <div class="text-white">
                                <div style="font-size: 2rem; font-weight: 700;">{{ $totalRole }}</div>
                                <div class="small opacity-75">Role Aktif</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 text-center p-3 rounded-4" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
                            <div class="text-white">
                                <div style="font-size: 2rem; font-weight: 700;">{{ $bulanIni }}</div>
                                <div class="small opacity-75">Kegiatan Bulan Ini</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gy-4">
                    @foreach($kegiatan as $item)
                        @php
                            $dok_ids = !empty($item->dokumentasi_ids) ? json_decode($item->dokumentasi_ids, true) : [];
                            $dok_ids = is_array($dok_ids) ? array_filter($dok_ids) : [];
                            $dok_list = count($dok_ids) > 0 ? \App\Models\Dokumentasi::whereIn('id', $dok_ids)->get() : collect();
                            $tanggal = \Carbon\Carbon::parse($item->tanggal_kegiatan);
                        @endphp
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 100 }}">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                                {{-- Gambar / Placeholder --}}
                                @if($dok_list->isNotEmpty())
                                    <div style="height: 200px; overflow: hidden; position: relative;">
                                        <img src="{{ asset('storage/' . $dok_list->first()->foto) }}"
                                            class="w-100 h-100" style="object-fit: cover;"
                                            alt="{{ $dok_list->first()->caption ?? 'Kegiatan' }}">
                                        {{-- Overlay done --}}
                                        <div style="position: absolute; inset: 0; background: rgba(17, 153, 142, 0.15);"></div>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="height: 200px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                                        <i class="bi bi-check-circle text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                                    </div>
                                @endif

                                {{-- Badge Terlaksana --}}
                                <div style="position: absolute; top: 12px; left: 12px;">
                                    <span class="badge bg-success px-3">
                                        <i class="bi bi-check-circle me-1"></i>Terlaksana
                                    </span>
                                </div>

                                {{-- Jika ada banyak foto --}}
                                @if($dok_list->count() > 1)
                                    <div style="position: absolute; top: 12px; right: 12px;">
                                        <span class="badge bg-dark bg-opacity-50 px-2">
                                            <i class="bi bi-images me-1"></i>{{ $dok_list->count() }}
                                        </span>
                                    </div>
                                @endif

                                <div class="card-body p-4">
                                    <div class="mb-2">
                                        <span class="badge me-1"
                                            style="background: linear-gradient(90deg, #4776e6, #8e54e9); font-size: 0.75rem;">
                                            {{ str_replace('_', ' ', $item->role) }}
                                        </span>
                                        @if($item->kategori)
                                            <span class="badge bg-light text-secondary" style="font-size: 0.75rem; border: 1px solid #dee2e6;">
                                                {{ $item->kategori }}
                                            </span>
                                        @endif
                                    </div>

                                    <h5 class="fw-bold mb-3" style="font-size: 0.95rem; line-height: 1.5;">
                                        {{ \Illuminate\Support\Str::limit($item->uraian, 80) }}
                                    </h5>

                                    <div class="d-flex flex-column gap-2 text-muted small">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-calendar-check text-success"></i>
                                            <span>{{ $tanggal->translatedFormat('l, d F Y') }}</span>
                                        </div>
                                        @if($item->tempat)
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-geo-alt text-success"></i>
                                                <span>{{ $item->tempat }}</span>
                                            </div>
                                        @endif
                                        @if($item->nama)
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-person text-success"></i>
                                                <span>{{ $item->nama }}{{ $item->jabatan ? ' · ' . $item->jabatan : '' }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Thumbnail dokumentasi --}}
                                    @if($dok_list->isNotEmpty())
                                        <div class="d-flex gap-1 mt-3 flex-wrap">
                                            @foreach($dok_list->take(4) as $dok)
                                                <img src="{{ asset('storage/' . $dok->foto) }}"
                                                    style="width: 42px; height: 42px; object-fit: cover; border-radius: 6px; border: 2px solid #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.15);"
                                                    alt="{{ $dok->caption }}">
                                            @endforeach
                                            @if($dok_list->count() > 4)
                                                <div class="d-flex align-items-center justify-content-center"
                                                    style="width: 42px; height: 42px; border-radius: 6px; background: #f0f0f0; font-size: 0.75rem; color: #666; font-weight: 600;">
                                                    +{{ $dok_list->count() - 4 }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-5">
                    {{ $kegiatan->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
