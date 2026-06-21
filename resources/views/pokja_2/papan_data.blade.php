@extends('admin-temp.layout_pokja_2')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_2.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Papan Data Pokja II</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Data Kegiatan PKK - Pokja II</h2>
                        <p class="text-muted mt-1">TP PKK Kelurahan Cipinang Melayu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="ti ti-alert-circle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="py-3">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#AddPapanDataModal"><i class="ti ti-plus me-1"></i> Tambah Data</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ImportModal"><i class="ti ti-file-import me-1"></i> Import File</button>
                    </div>
                    <table id="basic-btn-papan" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="3" class="align-middle text-center">NO</th>
                                <th rowspan="3" class="align-middle text-center">NAMA WILAYAH</th>
                                <th rowspan="3" class="align-middle text-center">JUMLAH WARGA YANG MASIH 3 BUTA</th>
                                <th colspan="22" class="text-center">PENDIDIKAN DAN KETERAMPILAN</th>
                                <th colspan="10" class="text-center">PENGEMBANGAN KEHIDUPAN KOPERASI</th>
                                <th rowspan="3" class="align-middle text-center">KET</th>
                                <th rowspan="3" class="align-middle text-center">ACTION</th>
                            </tr>
                            <tr>
                                <th colspan="8" class="text-center">JUMLAH KELOMPOK BELAJAR</th>
                                <th rowspan="2" class="align-middle text-center">PAUD SEJENIS</th>
                                <th rowspan="2" class="align-middle text-center">TAMAN BACAAN / PERPUSTAKAAN</th>
                                <th colspan="3" class="text-center">BKB</th>
                                <th rowspan="2" class="align-middle text-center">JML KLP SIMULASI</th>
                                <th colspan="5" class="text-center">TUTOR</th>
                                <th colspan="3" class="text-center">JUMLAH KADER YANG DILATIH</th>
                                <th colspan="2" class="text-center">PRA KOPERASI / UP2K</th>
                                <th colspan="2" class="text-center">MADYA</th>
                                <th colspan="2" class="text-center">UTAMA</th>
                                <th colspan="2" class="text-center">MANDIRI</th>
                                <th colspan="2" class="text-center">KOPERASI</th>
                            </tr>
                            <tr>
                                <th class="text-center">PAKET A KLP</th>
                                <th class="text-center">PAKET A WARGA</th>
                                <th class="text-center">PAKET B KLP</th>
                                <th class="text-center">PAKET B WARGA</th>
                                <th class="text-center">PAKET C KLP</th>
                                <th class="text-center">PAKET C WARGA</th>
                                <th class="text-center">KF KLP</th>
                                <th class="text-center">KF WARGA</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">JML IBU PESERTA</th>
                                <th class="text-center">JML APE (SET)</th>
                                <th class="text-center">KF</th>
                                <th class="text-center">PAUD SEJENIS</th>
                                <th class="text-center">BKB</th>
                                <th class="text-center">KOPERASI</th>
                                <th class="text-center">KETERAMPILAN</th>
                                <th class="text-center">LP3PKK</th>
                                <th class="text-center">TP PKK</th>
                                <th class="text-center">DAMAS PKK</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">PESERTA</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">PESERTA</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">PESERTA</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">PESERTA</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">JML ANGGOTA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($papan_data ?? [] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_wilayah ?? '-' }}</td>
                                    <td>{{ $item->tiga_buta ?? '-' }}</td>
                                    <td>{{ $item->paket_a_klp ?? '-' }}</td>
                                    <td>{{ $item->paket_a_warga ?? '-' }}</td>
                                    <td>{{ $item->paket_b_klp ?? '-' }}</td>
                                    <td>{{ $item->paket_b_warga ?? '-' }}</td>
                                    <td>{{ $item->paket_c_klp ?? '-' }}</td>
                                    <td>{{ $item->paket_c_warga ?? '-' }}</td>
                                    <td>{{ $item->kf_klp ?? '-' }}</td>
                                    <td>{{ $item->kf_warga ?? '-' }}</td>
                                    <td>{{ $item->paud ?? '-' }}</td>
                                    <td>{{ $item->taman_bacaan ?? '-' }}</td>
                                    <td>{{ $item->bkb_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->bkb_peserta ?? '-' }}</td>
                                    <td>{{ $item->bkb_ape ?? '-' }}</td>
                                    <td>{{ $item->jml_klp_simulasi ?? '-' }}</td>
                                    <td>{{ $item->tutor_kf ?? '-' }}</td>
                                    <td>{{ $item->tutor_paud ?? '-' }}</td>
                                    <td>{{ $item->tutor_bkb ?? '-' }}</td>
                                    <td>{{ $item->tutor_koperasi ?? '-' }}</td>
                                    <td>{{ $item->tutor_keterampilan ?? '-' }}</td>
                                    <td>{{ $item->kader_lp3pkk ?? '-' }}</td>
                                    <td>{{ $item->kader_tppkk ?? '-' }}</td>
                                    <td>{{ $item->kader_damas_pkk ?? '-' }}</td>
                                    <td>{{ $item->up2k_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->up2k_peserta ?? '-' }}</td>
                                    <td>{{ $item->koperasi_madya_klp ?? '-' }}</td>
                                    <td>{{ $item->koperasi_madya_peserta ?? '-' }}</td>
                                    <td>{{ $item->koperasi_utama_klp ?? '-' }}</td>
                                    <td>{{ $item->koperasi_utama_peserta ?? '-' }}</td>
                                    <td>{{ $item->mandiri_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->mandiri_peserta ?? '-' }}</td>
                                    <td>{{ $item->koperasi_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->koperasi_anggota ?? '-' }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-primary ti ti-edit" data-bs-toggle="modal" data-bs-target="#UpdatePapanDataModal-{{ $item->id }}"></button>
                                            <button type="button" class="btn btn-sm btn-danger ti ti-trash" data-bs-toggle="modal" data-bs-target="#DeletePapanDataModal-{{ $item->id }}"></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="fw-bold bg-light">
                                <th colspan="2" class="text-center align-middle">JUMLAH</th>
                                <th class="text-center">{{ $papan_data->sum('tiga_buta') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('paket_a_klp') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('paket_a_warga') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('paket_b_klp') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('paket_b_warga') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('paket_c_klp') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('paket_c_warga') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('kf_klp') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('kf_warga') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('paud') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('taman_bacaan') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('bkb_jml_klp') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('bkb_peserta') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('bkb_ape') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('jml_klp_simulasi') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('tutor_kf') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('tutor_paud') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('tutor_bkb') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('tutor_koperasi') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('tutor_keterampilan') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('kader_lp3pkk') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('kader_tppkk') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('kader_damas_pkk') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('up2k_jml_klp') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('up2k_peserta') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('koperasi_madya_klp') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('koperasi_madya_peserta') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('koperasi_utama_klp') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('koperasi_utama_peserta') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('mandiri_jml_klp') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('mandiri_peserta') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('koperasi_jml_klp') ?: '-' }}</th>
                                <th class="text-center">{{ $papan_data->sum('koperasi_anggota') ?: '-' }}</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin-temp.partials.import_modal', [
        'importRoute' => 'papan_data.import_pokja2',
        'title'       => 'Import Papan Data Pokja 2',
        'columns'     => 'nama_wilayah, tiga_buta, paket_a_klp, paket_a_warga, paket_b_klp, paket_b_warga, paket_c_klp, paket_c_warga, kf_klp, kf_warga, paud, taman_bacaan, bkb_jml_klp, bkb_peserta, bkb_ape, jml_klp_simulasi, tutor_kf, tutor_paud, tutor_bkb, tutor_koperasi, tutor_keterampilan, kader_lp3pkk, kader_tppkk, kader_damas_pkk, up2k_jml_klp, up2k_peserta, koperasi_madya_klp, koperasi_madya_peserta, koperasi_utama_klp, koperasi_utama_peserta, mandiri_jml_klp, mandiri_peserta, koperasi_jml_klp, koperasi_anggota, keterangan',
    ])

    <!-- Modal Tambah -->
    <div id="AddPapanDataModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Pokja II</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('papan_data.store_pokja2') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
<div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input type="text" class="form-control" name="nama_wilayah" required></div>
<div class="col-md-3 mb-3"><label class="form-label">3 Buta</label><input type="number" class="form-control" name="tiga_buta"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket A Klp</label><input type="number" class="form-control" name="paket_a_klp"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket A Warga</label><input type="number" class="form-control" name="paket_a_warga"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket B Klp</label><input type="number" class="form-control" name="paket_b_klp"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket B Warga</label><input type="number" class="form-control" name="paket_b_warga"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket C Klp</label><input type="number" class="form-control" name="paket_c_klp"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket C Warga</label><input type="number" class="form-control" name="paket_c_warga"></div>
<div class="col-md-3 mb-3"><label class="form-label">KF Klp</label><input type="number" class="form-control" name="kf_klp"></div>
<div class="col-md-3 mb-3"><label class="form-label">KF Warga</label><input type="number" class="form-control" name="kf_warga"></div>
<div class="col-md-3 mb-3"><label class="form-label">PAUD</label><input type="number" class="form-control" name="paud"></div>
<div class="col-md-3 mb-3"><label class="form-label">Taman Bacaan</label><input type="number" class="form-control" name="taman_bacaan"></div>
<div class="col-md-3 mb-3"><label class="form-label">BKB Jml Klp</label><input type="number" class="form-control" name="bkb_jml_klp"></div>
<div class="col-md-3 mb-3"><label class="form-label">BKB Peserta</label><input type="number" class="form-control" name="bkb_peserta"></div>
<div class="col-md-3 mb-3"><label class="form-label">BKB APE</label><input type="number" class="form-control" name="bkb_ape"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jml Klp Simulasi</label><input type="number" class="form-control" name="jml_klp_simulasi"></div>
<div class="col-md-3 mb-3"><label class="form-label">Tutor KF</label><input type="number" class="form-control" name="tutor_kf"></div>
<div class="col-md-3 mb-3"><label class="form-label">Tutor PAUD</label><input type="number" class="form-control" name="tutor_paud"></div>
<div class="col-md-3 mb-3"><label class="form-label">Tutor BKB</label><input type="number" class="form-control" name="tutor_bkb"></div>
<div class="col-md-3 mb-3"><label class="form-label">Tutor Koperasi</label><input type="number" class="form-control" name="tutor_koperasi"></div>
<div class="col-md-3 mb-3"><label class="form-label">Tutor Keterampilan</label><input type="number" class="form-control" name="tutor_keterampilan"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader LP3PKK</label><input type="number" class="form-control" name="kader_lp3pkk"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader TP PKK</label><input type="number" class="form-control" name="kader_tppkk"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader Damas PKK</label><input type="number" class="form-control" name="kader_damas_pkk"></div>
<div class="col-md-3 mb-3"><label class="form-label">Pra Koperasi Jml Klp</label><input type="number" class="form-control" name="up2k_jml_klp"></div>
<div class="col-md-3 mb-3"><label class="form-label">Pra Koperasi Peserta</label><input type="number" class="form-control" name="up2k_peserta"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Madya Klp</label><input type="number" class="form-control" name="koperasi_madya_klp"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Madya Peserta</label><input type="number" class="form-control" name="koperasi_madya_peserta"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Utama Klp</label><input type="number" class="form-control" name="koperasi_utama_klp"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Utama Peserta</label><input type="number" class="form-control" name="koperasi_utama_peserta"></div>
<div class="col-md-3 mb-3"><label class="form-label">Mandiri Jml Klp</label><input type="number" class="form-control" name="mandiri_jml_klp"></div>
<div class="col-md-3 mb-3"><label class="form-label">Mandiri Peserta</label><input type="number" class="form-control" name="mandiri_peserta"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Jml Klp</label><input type="number" class="form-control" name="koperasi_jml_klp"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Anggota</label><input type="number" class="form-control" name="koperasi_anggota"></div>
<div class="col-md-12 mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="3"></textarea></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($papan_data ?? [] as $item)
        <div id="UpdatePapanDataModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Update Data Pokja II</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('papan_data.update_pokja2', $item->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-body">
                            <div class="row">
<div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input type="text" class="form-control" name="nama_wilayah" value="{{ $item->nama_wilayah }}" required></div>
<div class="col-md-3 mb-3"><label class="form-label">3 Buta</label><input type="number" class="form-control" name="tiga_buta" value="{{ $item->tiga_buta }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket A Klp</label><input type="number" class="form-control" name="paket_a_klp" value="{{ $item->paket_a_klp }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket A Warga</label><input type="number" class="form-control" name="paket_a_warga" value="{{ $item->paket_a_warga }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket B Klp</label><input type="number" class="form-control" name="paket_b_klp" value="{{ $item->paket_b_klp }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket B Warga</label><input type="number" class="form-control" name="paket_b_warga" value="{{ $item->paket_b_warga }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket C Klp</label><input type="number" class="form-control" name="paket_c_klp" value="{{ $item->paket_c_klp }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Paket C Warga</label><input type="number" class="form-control" name="paket_c_warga" value="{{ $item->paket_c_warga }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">KF Klp</label><input type="number" class="form-control" name="kf_klp" value="{{ $item->kf_klp }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">KF Warga</label><input type="number" class="form-control" name="kf_warga" value="{{ $item->kf_warga }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">PAUD</label><input type="number" class="form-control" name="paud" value="{{ $item->paud }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Taman Bacaan</label><input type="number" class="form-control" name="taman_bacaan" value="{{ $item->taman_bacaan }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">BKB Jml Klp</label><input type="number" class="form-control" name="bkb_jml_klp" value="{{ $item->bkb_jml_klp }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">BKB Peserta</label><input type="number" class="form-control" name="bkb_peserta" value="{{ $item->bkb_peserta }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">BKB APE</label><input type="number" class="form-control" name="bkb_ape" value="{{ $item->bkb_ape }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jml Klp Simulasi</label><input type="number" class="form-control" name="jml_klp_simulasi" value="{{ $item->jml_klp_simulasi }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Tutor KF</label><input type="number" class="form-control" name="tutor_kf" value="{{ $item->tutor_kf }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Tutor PAUD</label><input type="number" class="form-control" name="tutor_paud" value="{{ $item->tutor_paud }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Tutor BKB</label><input type="number" class="form-control" name="tutor_bkb" value="{{ $item->tutor_bkb }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Tutor Koperasi</label><input type="number" class="form-control" name="tutor_koperasi" value="{{ $item->tutor_koperasi }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Tutor Keterampilan</label><input type="number" class="form-control" name="tutor_keterampilan" value="{{ $item->tutor_keterampilan }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader LP3PKK</label><input type="number" class="form-control" name="kader_lp3pkk" value="{{ $item->kader_lp3pkk }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader TP PKK</label><input type="number" class="form-control" name="kader_tppkk" value="{{ $item->kader_tppkk }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader Damas PKK</label><input type="number" class="form-control" name="kader_damas_pkk" value="{{ $item->kader_damas_pkk }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Pra Koperasi Jml Klp</label><input type="number" class="form-control" name="up2k_jml_klp" value="{{ $item->up2k_jml_klp }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Pra Koperasi Peserta</label><input type="number" class="form-control" name="up2k_peserta" value="{{ $item->up2k_peserta }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Madya Klp</label><input type="number" class="form-control" name="koperasi_madya_klp" value="{{ $item->koperasi_madya_klp }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Madya Peserta</label><input type="number" class="form-control" name="koperasi_madya_peserta" value="{{ $item->koperasi_madya_peserta }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Utama Klp</label><input type="number" class="form-control" name="koperasi_utama_klp" value="{{ $item->koperasi_utama_klp }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Utama Peserta</label><input type="number" class="form-control" name="koperasi_utama_peserta" value="{{ $item->koperasi_utama_peserta }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Mandiri Jml Klp</label><input type="number" class="form-control" name="mandiri_jml_klp" value="{{ $item->mandiri_jml_klp }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Mandiri Peserta</label><input type="number" class="form-control" name="mandiri_peserta" value="{{ $item->mandiri_peserta }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Jml Klp</label><input type="number" class="form-control" name="koperasi_jml_klp" value="{{ $item->koperasi_jml_klp }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Koperasi Anggota</label><input type="number" class="form-control" name="koperasi_anggota" value="{{ $item->koperasi_anggota }}"></div>
<div class="col-md-12 mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="3">{{ $item->keterangan }}</textarea></div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="DeletePapanDataModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Data</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('papan_data.destroy_pokja2', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="text-center p-3">
                                <h5>Hapus data <strong class="text-danger">{{ $item->nama_wilayah }}</strong>?</h5>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger"><i class="ti ti-trash"></i> Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection