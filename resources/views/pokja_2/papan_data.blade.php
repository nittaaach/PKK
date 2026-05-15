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
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button
                    type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="py-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#AddPapanDataModal"><i class="ti ti-plus me-1"></i> Tambah Data</button></div>
                    <table id="basic-btn-papan" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="3" class="align-middle text-center">NO</th>
                                <th rowspan="3" class="align-middle text-center">NAMA WILAYAH</th>
                                <th colspan="15" class="text-center">PENDIDIKAN DAN KETERAMPILAN</th>
                                <th colspan="6" class="text-center">PENGEMBANGAN KEHIDUPAN KOPERASI</th>
                                <th rowspan="3" class="align-middle text-center">KET</th>
                                <th rowspan="3" class="align-middle text-center">ACTION</th>
                            </tr>
                            <tr>
                                <th rowspan="2" class="text-center">3 BUTA</th>
                                <th colspan="2" class="text-center">PAKET A</th>
                                <th colspan="2" class="text-center">PAKET B</th>
                                <th colspan="2" class="text-center">PAKET C</th>
                                <th rowspan="2" class="text-center">PAUD</th>
                                <th rowspan="2" class="text-center">TAMAN BACAAN</th>
                                <th colspan="3" class="text-center">BKB</th>
                                <th rowspan="2" class="text-center">TUTOR</th>
                                <th rowspan="2" class="text-center">KADER DILATIH</th>
                                <th colspan="2" class="text-center">PRA KOPERASI/UP2K</th>
                                <th colspan="2" class="text-center">KOPERASI</th>
                                <th colspan="2" class="text-center">MANDIRI</th>
                            </tr>
                            <tr>
                                <th class="text-center">KLP</th>
                                <th class="text-center">WARGA</th>
                                <th class="text-center">KLP</th>
                                <th class="text-center">WARGA</th>
                                <th class="text-center">KLP</th>
                                <th class="text-center">WARGA</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">PESERTA</th>
                                <th class="text-center">APE</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">PESERTA</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">ANGGOTA</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">PESERTA</th>
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
                                    <td>{{ $item->paud ?? '-' }}</td>
                                    <td>{{ $item->taman_bacaan ?? '-' }}</td>
                                    <td>{{ $item->bkb_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->bkb_peserta ?? '-' }}</td>
                                    <td>{{ $item->bkb_ape ?? '-' }}</td>
                                    <td>{{ $item->tutor ?? '-' }}</td>
                                    <td>{{ $item->kader_dilatih ?? '-' }}</td>
                                    <td>{{ $item->up2k_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->up2k_peserta ?? '-' }}</td>
                                    <td>{{ $item->koperasi_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->koperasi_anggota ?? '-' }}</td>
                                    <td>{{ $item->mandiri_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->mandiri_peserta ?? '-' }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-primary ti ti-edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#UpdatePapanDataModal-{{ $item->id }}"></button>
                                            <button type="button" class="btn btn-sm btn-danger ti ti-trash"
                                                data-bs-toggle="modal"
                                                data-bs-target="#DeletePapanDataModal-{{ $item->id }}"></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="AddPapanDataModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Pokja II</h5><button type="button"
                        class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('papan_data.store_pokja2') }}" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input
                                    type="text" class="form-control" name="nama_wilayah" required></div>
                            <hr>
                            <h6>Pendidikan & Keterampilan</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">3 Buta</label><input type="number"
                                    class="form-control" name="tiga_buta"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Paket A KLP</label><input type="number"
                                    class="form-control" name="paket_a_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Paket A Warga</label><input
                                    type="number" class="form-control" name="paket_a_warga"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Paket B KLP</label><input type="number"
                                    class="form-control" name="paket_b_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Paket B Warga</label><input
                                    type="number" class="form-control" name="paket_b_warga"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Paket C KLP</label><input type="number"
                                    class="form-control" name="paket_c_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Paket C Warga</label><input
                                    type="number" class="form-control" name="paket_c_warga"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">PAUD</label><input type="number"
                                    class="form-control" name="paud"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Taman Bacaan</label><input
                                    type="number" class="form-control" name="taman_bacaan"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">BKB Jml KLP</label><input type="number"
                                    class="form-control" name="bkb_jml_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">BKB Peserta</label><input type="number"
                                    class="form-control" name="bkb_peserta"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">BKB APE</label><input type="number"
                                    class="form-control" name="bkb_ape"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Tutor</label><input type="number"
                                    class="form-control" name="tutor"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Kader Dilatih</label><input
                                    type="number" class="form-control" name="kader_dilatih"></div>
                            <hr>
                            <h6>Pengembangan Koperasi</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">UP2K Jml KLP</label><input
                                    type="number" class="form-control" name="up2k_jml_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">UP2K Peserta</label><input
                                    type="number" class="form-control" name="up2k_peserta"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Koperasi Jml KLP</label><input
                                    type="number" class="form-control" name="koperasi_jml_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Koperasi Anggota</label><input
                                    type="number" class="form-control" name="koperasi_anggota"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Mandiri Jml KLP</label><input
                                    type="number" class="form-control" name="mandiri_jml_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Mandiri Peserta</label><input
                                    type="number" class="form-control" name="mandiri_peserta"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Batal</button><button type="submit"
                            class="btn btn-primary">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($papan_data ?? [] as $item)
        <div id="UpdatePapanDataModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Update Data Pokja II</h5><button type="button"
                            class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('papan_data.update_pokja2', $item->id) }}" method="POST">@csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input
                                        type="text" class="form-control" name="nama_wilayah" required
                                        value="{{ $item->nama_wilayah }}"></div>
                                <hr>
                                <h6>Pendidikan & Keterampilan</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">3 Buta</label><input type="number"
                                        class="form-control" name="tiga_buta" value="{{ $item->tiga_buta }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Paket A KLP</label><input
                                        type="number" class="form-control" name="paket_a_klp"
                                        value="{{ $item->paket_a_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Paket A Warga</label><input
                                        type="number" class="form-control" name="paket_a_warga"
                                        value="{{ $item->paket_a_warga }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Paket B KLP</label><input
                                        type="number" class="form-control" name="paket_b_klp"
                                        value="{{ $item->paket_b_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Paket B Warga</label><input
                                        type="number" class="form-control" name="paket_b_warga"
                                        value="{{ $item->paket_b_warga }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Paket C KLP</label><input
                                        type="number" class="form-control" name="paket_c_klp"
                                        value="{{ $item->paket_c_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Paket C Warga</label><input
                                        type="number" class="form-control" name="paket_c_warga"
                                        value="{{ $item->paket_c_warga }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">PAUD</label><input type="number"
                                        class="form-control" name="paud" value="{{ $item->paud }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Taman Bacaan</label><input
                                        type="number" class="form-control" name="taman_bacaan"
                                        value="{{ $item->taman_bacaan }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">BKB Jml KLP</label><input
                                        type="number" class="form-control" name="bkb_jml_klp"
                                        value="{{ $item->bkb_jml_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">BKB Peserta</label><input
                                        type="number" class="form-control" name="bkb_peserta"
                                        value="{{ $item->bkb_peserta }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">BKB APE</label><input type="number"
                                        class="form-control" name="bkb_ape" value="{{ $item->bkb_ape }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Tutor</label><input type="number"
                                        class="form-control" name="tutor" value="{{ $item->tutor }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Kader Dilatih</label><input
                                        type="number" class="form-control" name="kader_dilatih"
                                        value="{{ $item->kader_dilatih }}"></div>
                                <hr>
                                <h6>Pengembangan Koperasi</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">UP2K Jml KLP</label><input
                                        type="number" class="form-control" name="up2k_jml_klp"
                                        value="{{ $item->up2k_jml_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">UP2K Peserta</label><input
                                        type="number" class="form-control" name="up2k_peserta"
                                        value="{{ $item->up2k_peserta }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Koperasi Jml KLP</label><input
                                        type="number" class="form-control" name="koperasi_jml_klp"
                                        value="{{ $item->koperasi_jml_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Koperasi Anggota</label><input
                                        type="number" class="form-control" name="koperasi_anggota"
                                        value="{{ $item->koperasi_anggota }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Mandiri Jml KLP</label><input
                                        type="number" class="form-control" name="mandiri_jml_klp"
                                        value="{{ $item->mandiri_jml_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Mandiri Peserta</label><input
                                        type="number" class="form-control" name="mandiri_peserta"
                                        value="{{ $item->mandiri_peserta }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" rows="5">{{ $item->keterangan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Batal</button><button type="submit"
                                class="btn btn-primary">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>

        <div id="DeletePapanDataModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Data</h5><button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('papan_data.destroy_pokja2', $item->id) }}" method="POST">@csrf
                            @method('DELETE')
                            <div class="text-center p-3">
                                <h5>Hapus data <strong class="text-danger">{{ $item->nama_wilayah }}</strong>?</h5>
                            </div>
                            <div class="modal-footer justify-content-center"><button type="button"
                                    class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button
                                    type="submit" class="btn btn-danger"><i class="ti ti-trash"></i> Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
