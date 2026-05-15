@extends('user-temp.layout')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Struktural</h1>
                        <p class="mb-0">Susunan kepengurusan PKK Jatiwaringin</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Struktural</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- ================= Ketua ================= -->
    <section id="ketua" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <p>Struktur Ketua</p>
            <h2>Susunan kepengurusan Ketua</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                @forelse ($ketua as $item)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid"
                                    alt="{{ $item->name }}" width="300" style="height: 300px; object-fit: cover;">
                                <div class="social">
                                    @if ($item->notelp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->notelp) }}" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $item->name ?? 'Tidak ada nama' }}</h4>
                                <span>{{ $item->keanggotaan_tp_pkk ?? 'Jabatan belum diatur' }}</span>
                                <p>{{ $item->alamat ?? 'Alamat tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada data Ketua.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= Wakil ================= -->
    <section id="wakil" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <p>Struktur Wakil Ketua</p>
            <h2>Susunan kepengurusan Wakil Ketua</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                @forelse ($wakil as $item)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid"
                                    alt="{{ $item->name }}" width="300" style="height: 300px; object-fit: cover;">
                                <div class="social">
                                    @if ($item->notelp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->notelp) }}" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $item->name ?? 'Tidak ada nama' }}</h4>
                                <span>{{ $item->keanggotaan_tp_pkk ?? 'Jabatan belum diatur' }}</span>
                                <p>{{ $item->alamat ?? 'Alamat tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada data Wakil Ketua.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= Bendahara ================= -->
    <section id="bendahara" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <p>Struktur Bendahara</p>
            <h2>Susunan kepengurusan Bendahara</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                @forelse ($bendahara as $item)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid"
                                    alt="{{ $item->name }}" width="300" style="height: 300px; object-fit: cover;">
                                <div class="social">
                                    @if ($item->notelp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->notelp) }}" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $item->name ?? 'Tidak ada nama' }}</h4>
                                <span>{{ $item->keanggotaan_tp_pkk ?? 'Jabatan belum diatur' }}</span>
                                <p>{{ $item->alamat ?? 'Alamat tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada data Bendahara.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= Sekretaris ================= -->
    <section id="sekretaris" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <p>Struktur Sekretaris</p>
            <h2>Susunan kepengurusan Sekretaris</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                @forelse ($sekretaris as $item)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid"
                                    alt="{{ $item->name }}" width="300" style="height: 300px; object-fit: cover;">
                                <div class="social">
                                    @if ($item->notelp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->notelp) }}" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $item->name ?? 'Tidak ada nama' }}</h4>
                                <span>{{ $item->keanggotaan_tp_pkk ?? 'Jabatan belum diatur' }}</span>
                                <p>{{ $item->alamat ?? 'Alamat tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada data Sekretaris.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= Pokja 1 ================= -->
    <section id="pokja_1" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <p>Struktur Pokja 1</p>
            <h2>Susunan kepengurusan Pokja 1</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                @forelse ($pokja1 as $item)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid"
                                    alt="{{ $item->name }}" width="300" style="height: 300px; object-fit: cover;">
                                <div class="social">
                                    @if ($item->notelp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->notelp) }}" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $item->name ?? 'Tidak ada nama' }}</h4>
                                <span>{{ $item->keanggotaan_tp_pkk ?? 'Jabatan belum diatur' }}</span>
                                <p>{{ $item->alamat ?? 'Alamat tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada data Pokja 1.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= Pokja 2 ================= -->
    <section id="pokja_2" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <p>Struktur Pokja 2</p>
            <h2>Susunan kepengurusan Pokja 2</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                @forelse ($pokja2 as $item)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid"
                                    alt="{{ $item->name }}" width="300" style="height: 300px; object-fit: cover;">
                                <div class="social">
                                    @if ($item->notelp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->notelp) }}" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $item->name ?? 'Tidak ada nama' }}</h4>
                                <span>{{ $item->keanggotaan_tp_pkk ?? 'Jabatan belum diatur' }}</span>
                                <p>{{ $item->alamat ?? 'Alamat tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada data Pokja 2.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= Pokja 3 ================= -->
    <section id="pokja_3" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <p>Struktur Pokja 3</p>
            <h2>Susunan kepengurusan Pokja 3</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                @forelse ($pokja3 as $item)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid"
                                    alt="{{ $item->name }}" width="300" style="height: 300px; object-fit: cover;">
                                <div class="social">
                                    @if ($item->notelp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->notelp) }}" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $item->name ?? 'Tidak ada nama' }}</h4>
                                <span>{{ $item->keanggotaan_tp_pkk ?? 'Jabatan belum diatur' }}</span>
                                <p>{{ $item->alamat ?? 'Alamat tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada data Pokja 3.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= Pokja 4 ================= -->
    <section id="pokja_4" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <p>Struktur Pokja 4</p>
            <h2>Susunan kepengurusan Pokja 4</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                @forelse ($pokja4 as $item)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid"
                                    alt="{{ $item->name }}" width="300" style="height: 300px; object-fit: cover;">
                                <div class="social">
                                    @if ($item->notelp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->notelp) }}" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $item->name ?? 'Tidak ada nama' }}</h4>
                                <span>{{ $item->keanggotaan_tp_pkk ?? 'Jabatan belum diatur' }}</span>
                                <p>{{ $item->alamat ?? 'Alamat tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada data Pokja 4.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection

