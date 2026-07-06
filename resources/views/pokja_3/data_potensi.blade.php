@extends($layout ?? 'admin-temp.layout_pokja_3')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ auth()->guard('ketua')->check() ? route('Ketua.dashboard') : (auth()->guard('wakil')->check() ? route('Wakil.dashboard') : route('Pokja_3.dashboard')) }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Data Potensi</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Data Potensi Pokja III @if($is_read_only ?? false) <span class="badge bg-info">Lihat Saja</span> @endif</h2>
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
            <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="ti ti-alert-circle me-1"></i> {{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    @if(!($is_read_only ?? false))
                    <div class="py-3">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#AddModal"><i class="ti ti-plus me-1"></i> Tambah Data Potensi</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ImportModal"><i class="ti ti-file-import me-1"></i> Import File</button>
                    </div>
                    @endif
                    <table id="basic-btn" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th  class="align-middle text-center">NO</th>
                                <th  class="align-middle text-center">WILAYAH</th>
                                <th  class="align-middle text-center">LUMBUNG HIDUP</th>
                                <th  class="align-middle text-center">WARUNG HIDUP</th>
                                <th  class="align-middle text-center">PETERNAKAN</th>
                                <th  class="align-middle text-center">PERIKANAN</th>
                                <th  class="align-middle text-center">TANAMAN PRODUKTIF</th>
                                <th  class="align-middle text-center">TOGA</th>
                                <th  class="align-middle text-center">TANAMAN KERAS</th>
                                <th  class="align-middle text-center">TANAMAN HIAS</th>
                                <th  class="align-middle text-center">TABULAPOT</th>
                                <th  class="align-middle text-center">JML KOMPOSTING</th>
                                <th  class="align-middle text-center">LRB</th>
                                <th  class="align-middle text-center">PILAH SAMPAH</th>
                                <th  class="align-middle text-center">KWT</th>
                                <th  class="align-middle text-center">POKTAN HATINYA PKK</th>
                                <th  class="align-middle text-center">URBAN FARMING</th>
                                <th  class="align-middle text-center">KETERANGAN</th>
                                @if(!($is_read_only ?? false))
                                <th  class="align-middle text-center">ACTION</th>
                                @endif
                            </tr>
                            
                        </thead>
                        <tbody>
                            @foreach ($data ?? [] as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->wilayah ?? '-' }}</td>
                                    <td class="text-center">{{ $item->lumbung_hidup ?? '-' }}</td>
                                    <td class="text-center">{{ $item->warung_hidup ?? '-' }}</td>
                                    <td class="text-center">{{ $item->peternakan ?? '-' }}</td>
                                    <td class="text-center">{{ $item->perikanan ?? '-' }}</td>
                                    <td class="text-center">{{ $item->tanaman_produktif ?? '-' }}</td>
                                    <td class="text-center">{{ $item->toga ?? '-' }}</td>
                                    <td class="text-center">{{ $item->tanaman_keras ?? '-' }}</td>
                                    <td class="text-center">{{ $item->tanaman_hias ?? '-' }}</td>
                                    <td class="text-center">{{ $item->tabulapot ?? '-' }}</td>
                                    <td class="text-center">{{ $item->jumlah_komposting ?? '-' }}</td>
                                    <td class="text-center">{{ $item->lrb ?? '-' }}</td>
                                    <td class="text-center">{{ $item->pilah_sampah ?? '-' }}</td>
                                    <td class="text-center">{{ $item->kwt ?? '-' }}</td>
                                    <td class="text-center">{{ $item->poktan_hatinya_pkk ?? '-' }}</td>
                                    <td class="text-center">{{ $item->urban_farming ?? '-' }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    @if(!($is_read_only ?? false))
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-primary ti ti-edit" data-bs-toggle="modal" data-bs-target="#UpdateModal-{{ $item->id }}"></button>
                                            <button type="button" class="btn btn-sm btn-danger ti ti-trash" data-bs-toggle="modal" data-bs-target="#DeleteModal-{{ $item->id }}"></button>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold bg-light">
                                <th colspan="2" class="text-center align-middle">JUMLAH</th>
                                <th class="text-center">{{ $data->sum('lumbung_hidup') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('warung_hidup') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('peternakan') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('perikanan') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('tanaman_produktif') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('toga') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('tanaman_keras') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('tanaman_hias') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('tabulapot') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('jumlah_komposting') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('lrb') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('pilah_sampah') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('kwt') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('poktan_hatinya_pkk') ?: '-' }}</th>
                                <th class="text-center">{{ $data->sum('urban_farming') ?: '-' }}</th>
                                <th class="text-center"></th>
                                @if(!($is_read_only ?? false))
                                <th class="text-center"></th>
                                @endif
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div id="AddModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Potensi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('data_potensi.store_pokja3') }}" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3"><label class="form-label">Wilayah *</label><input type="text" class="form-control" name="wilayah" required></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Lumbung Hidup</label><input type="number" class="form-control" name="lumbung_hidup"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Warung Hidup</label><input type="number" class="form-control" name="warung_hidup"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Peternakan</label><input type="number" class="form-control" name="peternakan"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Perikanan</label><input type="number" class="form-control" name="perikanan"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Tanaman Produktif</label><input type="number" class="form-control" name="tanaman_produktif"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Toga</label><input type="number" class="form-control" name="toga"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Tanaman Keras</label><input type="number" class="form-control" name="tanaman_keras"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Tanaman Hias</label><input type="number" class="form-control" name="tanaman_hias"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Tabulapot</label><input type="number" class="form-control" name="tabulapot"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Jumlah Komposting</label><input type="number" class="form-control" name="jumlah_komposting"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">LRB</label><input type="number" class="form-control" name="lrb"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Pilah Sampah</label><input type="number" class="form-control" name="pilah_sampah"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">KWT</label><input type="number" class="form-control" name="kwt"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Poktan Hatinya PKK</label><input type="number" class="form-control" name="poktan_hatinya_pkk"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Urban Farming</label><input type="number" class="form-control" name="urban_farming"></div>
                            <div class="col-md-12 mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="2"></textarea></div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data ?? [] as $item)
        <div id="UpdateModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">Edit Data Potensi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('data_potensi.update_pokja3', $item->id) }}" method="POST">@csrf @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Wilayah *</label><input type="text" class="form-control" name="wilayah" value="{{ $item->wilayah }}" required></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Lumbung Hidup</label><input type="number" class="form-control" name="lumbung_hidup" value="{{ $item->lumbung_hidup }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Warung Hidup</label><input type="number" class="form-control" name="warung_hidup" value="{{ $item->warung_hidup }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Peternakan</label><input type="number" class="form-control" name="peternakan" value="{{ $item->peternakan }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Perikanan</label><input type="number" class="form-control" name="perikanan" value="{{ $item->perikanan }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Tanaman Produktif</label><input type="number" class="form-control" name="tanaman_produktif" value="{{ $item->tanaman_produktif }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Toga</label><input type="number" class="form-control" name="toga" value="{{ $item->toga }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Tanaman Keras</label><input type="number" class="form-control" name="tanaman_keras" value="{{ $item->tanaman_keras }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Tanaman Hias</label><input type="number" class="form-control" name="tanaman_hias" value="{{ $item->tanaman_hias }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Tabulapot</label><input type="number" class="form-control" name="tabulapot" value="{{ $item->tabulapot }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Jumlah Komposting</label><input type="number" class="form-control" name="jumlah_komposting" value="{{ $item->jumlah_komposting }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">LRB</label><input type="number" class="form-control" name="lrb" value="{{ $item->lrb }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Pilah Sampah</label><input type="number" class="form-control" name="pilah_sampah" value="{{ $item->pilah_sampah }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">KWT</label><input type="number" class="form-control" name="kwt" value="{{ $item->kwt }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Poktan Hatinya PKK</label><input type="number" class="form-control" name="poktan_hatinya_pkk" value="{{ $item->poktan_hatinya_pkk }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Urban Farming</label><input type="number" class="form-control" name="urban_farming" value="{{ $item->urban_farming }}"></div>
                                <div class="col-md-12 mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="2">{{ $item->keterangan }}</textarea></div>
                            </div>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-warning">Update</button></div>
                    </form>
                </div>
            </div>
        </div>
        <div id="DeleteModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Data</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('data_potensi.destroy_pokja3', $item->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="text-center p-3"><h5>Hapus data wilayah <strong class="text-danger">{{ $item->wilayah }}</strong>?</h5></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger"><i class="ti ti-trash"></i> Hapus</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Import -->
    <div id="ImportModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import File Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('Pokja_3.import_data_potensi') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-info">
                            Pastikan format file excel sesuai dengan urutan kolom di tabel. Data akan dibaca dari baris pertama yang berisi angka di kolom No.
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih File (Excel / CSV)</label>
                            <input type="file" class="form-control" name="import_file" accept=".xlsx, .xls, .csv" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection