@extends($layout)

@section('content_admin')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Profil Akun</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Detail Profil Akun</h2>
                    <p class="text-muted mt-1">Informasi lengkap terkait anggota PKK</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary bg-opacity-10">
                <h5 class="mb-0 text-primary"><i class="ti ti-user me-2"></i> Informasi Akun</h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4 text-center mb-4 border-end">
                        <div class="mb-4">
                            @if ($anggota && $anggota->foto)
                                <img src="{{ asset('storage/' . $anggota->foto) }}" alt="user-image" class="img-fluid rounded-circle img-thumbnail shadow" style="width: 180px; height: 180px; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets_admin/images/user/avatar-2.jpg') }}" alt="user-image" class="img-fluid rounded-circle img-thumbnail shadow" style="width: 180px; height: 180px; object-fit: cover;">
                            @endif
                        </div>
                        <h4 class="mt-3 fw-bold">{{ $anggota->name ?? $user->name ?? '-' }}</h4>
                        <span class="badge bg-primary fs-6">{{ $user->role ?? 'Tidak Ada Role' }}</span>
                        <div class="mt-3">
                            <span class="d-block text-muted mb-1"><i class="ti ti-mail me-1"></i> {{ $user->email ?? $anggota->email ?? '-' }}</span>
                            <span class="d-block text-muted"><i class="ti ti-phone me-1"></i> {{ $anggota->notelp ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h5 class="mb-4 text-secondary border-bottom pb-2">Detail Data Anggota</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless align-middle">
                                <tbody>
                                    <tr>
                                        <th width="35%" class="text-muted">Nomor Registrasi</th>
                                        <td width="5%">:</td>
                                        <td class="fw-semibold">{{ $anggota->no_registrasi ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Jenis Kelamin</th>
                                        <td>:</td>
                                        <td class="fw-semibold">{{ $anggota->jenis_kelamin ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Tempat, Tanggal Lahir</th>
                                        <td>:</td>
                                        <td class="fw-semibold">{{ $anggota->tempat_lahir ?? '-' }}, {{ $anggota->tanggal_lahir ?? '-' }} <span class="badge bg-light text-dark border">{{ $anggota->umur ?? '-' }} Tahun</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Status Perkawinan</th>
                                        <td>:</td>
                                        <td class="fw-semibold">{{ $anggota->status_perkawinan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Pendidikan Terakhir</th>
                                        <td>:</td>
                                        <td class="fw-semibold">{{ $anggota->pendidikan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Pekerjaan</th>
                                        <td>:</td>
                                        <td class="fw-semibold">{{ $anggota->pekerjaan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Alamat Lengkap</th>
                                        <td>:</td>
                                        <td class="fw-semibold">{{ $anggota->alamat ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Peran (Role PKK)</th>
                                        <td>:</td>
                                        <td class="fw-semibold">{{ $anggota->role_pkk ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Keanggotaan TP PKK</th>
                                        <td>:</td>
                                        <td class="fw-semibold">{{ $anggota->keanggotaan_tp_pkk ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Kader Umum</th>
                                        <td>:</td>
                                        <td class="fw-semibold">{{ $anggota->kader_umum ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Kader Khusus</th>
                                        <td>:</td>
                                        <td class="fw-semibold">{{ $anggota->kader_khusus ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Keterangan</th>
                                        <td>:</td>
                                        <td class="fw-semibold">{{ $anggota->keterangan ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light text-end py-3">
                <button class="btn btn-secondary px-4" onclick="window.history.back()"><i class="ti ti-arrow-left me-1"></i> Kembali</button>
            </div>
        </div>
    </div>
</div>
@endsection
