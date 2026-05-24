@extends('user-temp.layout')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Kegiatan Akan Datang</h1>
                        <p class="mb-0">Agenda Mendatang TP PKK Kelurahan Cipinang Melayu</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('landing') }}">Home</a></li>
                    <li class="current">Kegiatan</li>
                    <li class="current">Akan Datang</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <section class="section py-5">
        <div class="container">

            {{-- Filter Role --}}
            <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
                <a href="{{ route('kegiatan.akan_datang') }}"
                    class="btn {{ !request('role') ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4">
                    Semua
                </a>
                @foreach(['Sekretaris', 'Pokja_1', 'Pokja_2', 'Pokja_3', 'Pokja_4'] as $r)
                <a href="{{ route('kegiatan.akan_datang', ['role' => $r]) }}"
                    class="btn {{ request('role') == $r ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4">
                    {{ str_replace('_', ' ', $r) }}
                </a>
                @endforeach
            </div>

            @if($kegiatan->isEmpty())
                <div class="text-center py-5">
                    <div style="font-size: 5rem; color: #ccc;"><i class="bi bi-calendar-x"></i></div>
                    <h4 class="text-muted mt-3">Belum ada kegiatan yang dijadwalkan</h4>
                    <p class="text-muted">Pantau terus untuk update kegiatan terbaru.</p>
                </div>
            @else
                <div class="row gy-4">
                    @foreach($kegiatan as $item)
                        @php
                            $dok_ids = !empty($item->dokumentasi_ids) ? json_decode($item->dokumentasi_ids, true) : [];
                            $dok_ids = is_array($dok_ids) ? array_filter($dok_ids) : [];
                            $dok_list = count($dok_ids) > 0 ? \App\Models\Dokumentasi::whereIn('id', $dok_ids)->get() : collect();
                            $tanggal = \Carbon\Carbon::parse($item->tanggal_kegiatan);
                            $selisih = (int) now()->startOfDay()->diffInDays($tanggal->copy()->startOfDay(), false);
                        @endphp
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 100 }}">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                                {{-- Gambar / Placeholder --}}
                                @if($dok_list->isNotEmpty())
                                    <div style="height: 200px; overflow: hidden;">
                                        <img src="{{ asset('storage/' . $dok_list->first()->foto) }}"
                                            class="w-100 h-100" style="object-fit: cover;"
                                            alt="{{ $dok_list->first()->caption ?? 'Kegiatan' }}">
                                    </div>
                                @else
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <i class="bi bi-calendar-event text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                                    </div>
                                @endif

                                {{-- Badge Countdown --}}
                                <div style="position: absolute; top: 12px; right: 12px;">
                                    @if($selisih == 0)
                                        <span class="badge bg-danger fs-6 px-3">Hari Ini!</span>
                                    @elseif($selisih == 1)
                                        <span class="badge bg-warning text-dark fs-6 px-3">Besok</span>
                                    @elseif($selisih <= 7)
                                        <span class="badge bg-info fs-6 px-3">{{ $selisih }} Hari Lagi</span>
                                    @else
                                        <span class="badge bg-secondary px-3">{{ $tanggal->translatedFormat('d M Y') }}</span>
                                    @endif
                                </div>

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
                                            <i class="bi bi-calendar3 text-primary"></i>
                                            <span>{{ $tanggal->translatedFormat('l, d F Y') }}</span>
                                        </div>
                                        @if($item->tempat)
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-geo-alt text-primary"></i>
                                                <span>{{ $item->tempat }}</span>
                                            </div>
                                        @endif
                                        @if($item->nama)
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-person text-primary"></i>
                                                <span>{{ $item->nama }}{{ $item->jabatan ? ' · ' . $item->jabatan : '' }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if($dok_list->count() > 1)
                                    <div class="card-footer bg-light border-0 px-4 py-2">
                                        <small class="text-muted">
                                            <i class="bi bi-images me-1"></i> {{ $dok_list->count() }} foto dokumentasi
                                        </small>
                                    </div>
                                @endif
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
