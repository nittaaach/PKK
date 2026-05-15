@extends('admin-temp.layout_sekretaris')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Sekretaris.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Data Potensi Wilayah</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Data Potensi Wilayah</h2>
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
                            data-bs-target="#AddPotensiModal"><i class="ti ti-plus me-1"></i> Tambah Data</button></div>
                    <table id="basic-btn-potensi" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle text-center">NO</th>
                                <th rowspan="2" class="align-middle text-center">WILAYAH</th>
                                <th colspan="5" class="text-center">JUMLAH</th>
                                <th colspan="2" class="text-center">PIK KELUARGA</th>
                                <th rowspan="2" class="align-middle text-center">MAJELIS<br>TAKLIM</th>
                                <th rowspan="2" class="align-middle text-center">PAAR</th>
                                <th rowspan="2" class="align-middle text-center">POLA<br>ASUH</th>
                                <th colspan="3" class="text-center">BKB PAUD</th>
                                <th rowspan="2" class="align-middle text-center">KOPERASI</th>
                                <th rowspan="2" class="align-middle text-center">TAMAN<br>BACAAN</th>
                                <th rowspan="2" class="align-middle text-center">UP2K<br>UNGGULAN</th>
                                <th rowspan="2" class="align-middle text-center">HATINYA<br>PKK</th>
                                <th rowspan="2" class="align-middle text-center">KADER<br>PANGAN</th>
                                <th rowspan="2" class="align-middle text-center">BANK<br>SAMPAH</th>
                                <th rowspan="2" class="align-middle text-center">KOMPOS<br>TING</th>
                                <th colspan="3" class="text-center">POSYANDU</th>
                                <th rowspan="2" class="align-middle text-center">KADER<br>JUMANTIK</th>
                                <th rowspan="2" class="align-middle text-center">RW<br>PERCONTOHAN</th>
                                <th rowspan="2" class="align-middle text-center">KET</th>
                                <th rowspan="2" class="align-middle text-center">ACTION</th>
                            </tr>
                            <tr>
                                <th class="text-center">PKK RW</th>
                                <th class="text-center">PKK RT</th>
                                <th class="text-center">DASA WISMA</th>
                                <th class="text-center">KRT</th>
                                <th class="text-center">KK</th>
                                <th class="text-center">AKTIF</th>
                                <th class="text-center">TDK AKTIF</th>
                                <th class="text-center">BKB</th>
                                <th class="text-center">PAUD</th>
                                <th class="text-center">KF</th>
                                <th class="text-center">BALITA</th>
                                <th class="text-center">LANSIA</th>
                                <th class="text-center">POSBINDU</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_potensi ?? [] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->dasa_wisma ?? '-' }}</td>
                                    <td>{{ $item->krt ?? '-' }}</td>
                                    <td>{{ $item->kk ?? '-' }}</td>
                                    <td>{{ $item->pik_aktif ?? '-' }}</td>
                                    <td>{{ $item->pik_tidak_aktif ?? '-' }}</td>
                                    <td>{{ $item->majelis_taklim ?? '-' }}</td>
                                    <td>{{ $item->paar ?? '-' }}</td>
                                    <td>{{ $item->pola_asuh ?? '-' }}</td>
                                    <td>{{ $item->bkb ?? '-' }}</td>
                                    <td>{{ $item->paud ?? '-' }}</td>
                                    <td>{{ $item->kf ?? '-' }}</td>
                                    <td>{{ $item->koperasi ?? '-' }}</td>
                                    <td>{{ $item->taman_bacaan ?? '-' }}</td>
                                    <td>{{ $item->up2k_unggulan ?? '-' }}</td>
                                    <td>{{ $item->hatinya_pkk ?? '-' }}</td>
                                    <td>{{ $item->kader_pangan ?? '-' }}</td>
                                    <td>{{ $item->bank_sampah ?? '-' }}</td>
                                    <td>{{ $item->komposting ?? '-' }}</td>
                                    <td>{{ $item->posyandu_balita ?? '-' }}</td>
                                    <td>{{ $item->posyandu_lansia ?? '-' }}</td>
                                    <td>{{ $item->posbindu ?? '-' }}</td>
                                    <td>{{ $item->kader_jumantik ?? '-' }}</td>
                                    <td>{{ $item->rw_percontohan ?? '-' }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-primary ti ti-edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#UpdatePotensiModal-{{ $item->id }}"></button>
                                            <button type="button" class="btn btn-sm btn-danger ti ti-trash"
                                                data-bs-toggle="modal"
                                                data-bs-target="#DeletePotensiModal-{{ $item->id }}"></button>
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

    <div id="AddPotensiModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Potensi Wilayah</h5><button type="button"
                        class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('data_potensi.store_sekretaris') }}" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3"><label class="form-label">Wilayah *</label><input type="text"
                                    class="form-control" name="wilayah" required></div>
                            <hr>
                            <h6>Jumlah</h6>
                            <div class="col-md-4 mb-3"><label class="form-label">PKK RW</label><input type="number"
                                    class="form-control" name="pkk_rw"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">PKK RT</label><input type="number"
                                    class="form-control" name="pkk_rt"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Dasa Wisma</label><input type="number"
                                    class="form-control" name="dasa_wisma"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">KRT</label><input type="number"
                                    class="form-control" name="krt"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">KK</label><input type="number"
                                    class="form-control" name="kk"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">PIK Aktif</label><input type="number"
                                    class="form-control" name="pik_aktif"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">PIK Tidak Aktif</label><input
                                    type="number" class="form-control" name="pik_tidak_aktif"></div>
                            <hr>
                            <h6>Kegiatan</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">Majelis Taklim</label><input
                                    type="number" class="form-control" name="majelis_taklim"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">PAAR</label><input type="number"
                                    class="form-control" name="paar"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Pola Asuh</label><input type="number"
                                    class="form-control" name="pola_asuh"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">BKB</label><input type="number"
                                    class="form-control" name="bkb"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">PAUD</label><input type="number"
                                    class="form-control" name="paud"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">KF</label><input type="number"
                                    class="form-control" name="kf"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Koperasi</label><input type="number"
                                    class="form-control" name="koperasi"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Taman Bacaan</label><input
                                    type="number" class="form-control" name="taman_bacaan"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">UP2K Unggulan</label><input
                                    type="number" class="form-control" name="up2k_unggulan"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Hatinya PKK</label><input type="number"
                                    class="form-control" name="hatinya_pkk"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Kader Pangan</label><input
                                    type="number" class="form-control" name="kader_pangan"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Bank Sampah</label><input type="number"
                                    class="form-control" name="bank_sampah"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Komposting</label><input type="number"
                                    class="form-control" name="komposting"></div>
                            <hr>
                            <h6>Posyandu</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">Balita</label><input type="number"
                                    class="form-control" name="posyandu_balita"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Lansia</label><input type="number"
                                    class="form-control" name="posyandu_lansia"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Posbindu</label><input type="number"
                                    class="form-control" name="posbindu"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Kader Jumantik</label><input
                                    type="number" class="form-control" name="kader_jumantik"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">RW Percontohan</label><input
                                    type="number" class="form-control" name="rw_percontohan"></div>
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

    @foreach ($data_potensi ?? [] as $item)
        <div id="UpdatePotensiModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Update Data Potensi Wilayah</h5><button type="button"
                            class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('data_potensi.update_sekretaris', $item->id) }}" method="POST">@csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Wilayah *</label><input
                                        type="text" class="form-control" name="wilayah" required
                                        value="{{ $item->wilayah }}"></div>
                                <hr>
                                <h6>Jumlah</h6>
                                <div class="col-md-4 mb-3"><label class="form-label">PKK RW</label><input type="number"
                                        class="form-control" name="pkk_rw" value="{{ $item->pkk_rw }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">PKK RT</label><input type="number"
                                        class="form-control" name="pkk_rt" value="{{ $item->pkk_rt }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Dasa Wisma</label><input
                                        type="number" class="form-control" name="dasa_wisma"
                                        value="{{ $item->dasa_wisma }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">KRT</label><input type="number"
                                        class="form-control" name="krt" value="{{ $item->krt }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">KK</label><input type="number"
                                        class="form-control" name="kk" value="{{ $item->kk }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">PIK Aktif</label><input
                                        type="number" class="form-control" name="pik_aktif"
                                        value="{{ $item->pik_aktif }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">PIK Tidak Aktif</label><input
                                        type="number" class="form-control" name="pik_tidak_aktif"
                                        value="{{ $item->pik_tidak_aktif }}"></div>
                                <hr>
                                <h6>Kegiatan</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">Majelis Taklim</label><input
                                        type="number" class="form-control" name="majelis_taklim"
                                        value="{{ $item->majelis_taklim }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">PAAR</label><input type="number"
                                        class="form-control" name="paar" value="{{ $item->paar }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Pola Asuh</label><input
                                        type="number" class="form-control" name="pola_asuh"
                                        value="{{ $item->pola_asuh }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">BKB</label><input type="number"
                                        class="form-control" name="bkb" value="{{ $item->bkb }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">PAUD</label><input type="number"
                                        class="form-control" name="paud" value="{{ $item->paud }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">KF</label><input type="number"
                                        class="form-control" name="kf" value="{{ $item->kf }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Koperasi</label><input
                                        type="number" class="form-control" name="koperasi"
                                        value="{{ $item->koperasi }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Taman Bacaan</label><input
                                        type="number" class="form-control" name="taman_bacaan"
                                        value="{{ $item->taman_bacaan }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">UP2K Unggulan</label><input
                                        type="number" class="form-control" name="up2k_unggulan"
                                        value="{{ $item->up2k_unggulan }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Hatinya PKK</label><input
                                        type="number" class="form-control" name="hatinya_pkk"
                                        value="{{ $item->hatinya_pkk }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Kader Pangan</label><input
                                        type="number" class="form-control" name="kader_pangan"
                                        value="{{ $item->kader_pangan }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Bank Sampah</label><input
                                        type="number" class="form-control" name="bank_sampah"
                                        value="{{ $item->bank_sampah }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Komposting</label><input
                                        type="number" class="form-control" name="komposting"
                                        value="{{ $item->komposting }}"></div>
                                <hr>
                                <h6>Posyandu</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">Balita</label><input type="number"
                                        class="form-control" name="posyandu_balita"
                                        value="{{ $item->posyandu_balita }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Lansia</label><input type="number"
                                        class="form-control" name="posyandu_lansia"
                                        value="{{ $item->posyandu_lansia }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Posbindu</label><input
                                        type="number" class="form-control" name="posbindu"
                                        value="{{ $item->posbindu }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Kader Jumantik</label><input
                                        type="number" class="form-control" name="kader_jumantik"
                                        value="{{ $item->kader_jumantik }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">RW Percontohan</label><input
                                        type="number" class="form-control" name="rw_percontohan"
                                        value="{{ $item->rw_percontohan }}"></div>
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

        <div id="DeletePotensiModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Data</h5><button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('data_potensi.destroy_sekretaris', $item->id) }}" method="POST">@csrf
                            @method('DELETE')
                            <div class="text-center p-3">
                                <h5>Hapus data <strong class="text-danger">{{ $item->wilayah }}</strong>?</h5>
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
