@extends('admin-temp.layout_sekretaris')
@section('content_admin')
    <!-- [ Main Content ] start -->

    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Sekretaris.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Administrasi</a></li>
                        <li class="breadcrumb-item" aria-current="page">Agenda Surat</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Buku Agenda Surat</h2>
                        <p class="text-muted mt-1">Tim Penggerak PKK Kelurahan Cipinang Melayu - Kecamatan Makasar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Button Switcher Surat Masuk / Surat Keluar -->
        <ul class="nav nav-pills mb-3" id="agendaSuratTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="surat-masuk-tab" data-bs-toggle="pill" data-bs-target="#surat-masuk"
                    type="button" role="tab" aria-controls="surat-masuk" aria-selected="true">
                    <i class="ti ti-mail-forward me-1"></i> Surat Masuk
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="surat-keluar-tab" data-bs-toggle="pill" data-bs-target="#surat-keluar"
                    type="button" role="tab" aria-controls="surat-keluar" aria-selected="false">
                    <i class="ti ti-mail me-1"></i> Surat Keluar
                </button>
            </li>
        </ul>

        <div class="tab-content" id="agendaSuratTabContent">
            <!-- ==================== TABLE SURAT MASUK ==================== -->
            <div class="tab-pane fade show active" id="surat-masuk" role="tabpanel" aria-labelledby="surat-masuk-tab">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0 text-white">
                            <i class="ti ti-mail-forward me-2"></i>Buku Agenda Surat Masuk
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <div class="py-3">
                                <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                                    data-bs-target="#AddSuratMasukModal">
                                    <i class="ti ti-plus me-1"></i> Tambah Surat Masuk
                                </button>
                            </div>
                            <table id="basic-btn-suratm" class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">NO</th>
                                        <th class="align-middle text-center">TANGGAL TERIMA<br>SURAT</th>
                                        <th class="align-middle text-center">TANGGAL<br>SURAT</th>
                                        <th class="align-middle text-center">NOMOR SURAT</th>
                                        <th class="align-middle text-center">ASAL SURAT / DARI</th>
                                        <th class="align-middle text-center">PERIHAL</th>
                                        <th class="align-middle text-center">LAMPIRAN</th>
                                        <th class="align-middle text-center">DITERUSKAN KEPADA</th>
                                        <th class="align-middle text-center">ACTION</th>
                                    </tr>

                                    <!-- Baris Penomoran Kolom -->
                                    <tr class="bg-blue-200">
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">6</th>
                                        <th class="text-center">7</th>
                                        <th class="text-center">8</th>
                                        <th class="text-center">9</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surat_masuk ?? [] as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal_terima ? \Carbon\Carbon::parse($item->tanggal_terima)->translatedFormat('d/m/Y') : '-' }}
                                            </td>
                                            <td>{{ $item->tanggal_surat ? \Carbon\Carbon::parse($item->tanggal_surat)->translatedFormat('d/m/Y') : '-' }}
                                            </td>
                                            <td style="min-width: 200px; max-width: 400px; white-space: normal;">
                                                {{ $item->no_surat ?? '-' }}</td>
                                            <td style="min-width: 200px; max-width: 400px; white-space: normal;">
                                                {{ $item->asal_surat ?? '-' }}</td>
                                            <td style="min-width: 400px; max-width: 800px; white-space: normal;">
                                                {!! nl2br(e(\Illuminate\Support\Str::limit($item->perihal, 1000) ?? '-')) !!}</td>
                                            <td>{{ $item->lampiran ?? '-' }}</td>
                                            <td style="min-width: 100px; max-width: 200px; white-space: normal;">
                                                {{ $item->diteruskan_kepada ?? '-' }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-sm btn-primary ti ti-edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdateSuratMasukModal-{{ $item->id }}"></button>
                                                    <button type="button" class="btn btn-sm btn-danger ti ti-trash"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeleteSuratMasukModal-{{ $item->id }}"></button>
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

            <!-- ==================== TABLE SURAT KELUAR ==================== -->
            <div class="tab-pane fade" id="surat-keluar" role="tabpanel" aria-labelledby="surat-keluar-tab">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0 text-white">
                            <i class="ti ti-mail me-2"></i>Buku Agenda Surat Keluar
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <div class="py-3">
                                <button type="button" class="btn btn-success me-3" data-bs-toggle="modal"
                                    data-bs-target="#AddSuratKeluarModal">
                                    <i class="ti ti-plus me-1"></i> Tambah Surat Keluar
                                </button>
                            </div>
                            <table id="basic-btn-suratk" class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">NO</th>
                                        <th class="align-middle text-center">NO. DAN<br>KODE SURAT</th>
                                        <th class="align-middle text-center">TANGGAL<br>SURAT</th>
                                        <th class="align-middle text-center">KEPADA</th>
                                        <th class="align-middle text-center">PERIHAL</th>
                                        <th class="align-middle text-center">LAMPIRAN</th>
                                        <th class="align-middle text-center">TEMBUSAN</th>
                                        <th class="align-middle text-center">ACTION</th>
                                    </tr>
                                    <!-- Baris Penomoran Kolom -->
                                    <tr class="bg-blue-200">
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">6</th>
                                        <th class="text-center">7</th>
                                        <th class="text-center">8</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surat_keluar ?? [] as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nomor_kode_surat ?? '-' }}</td>
                                            <td>{{ $item->tanggal_surat ? \Carbon\Carbon::parse($item->tanggal_surat)->translatedFormat('d/m/Y') : '-' }}
                                            </td>
                                            <td style="min-width: 200px; max-width: 400px; white-space: normal;">
                                                {{ $item->kepada ?? '-' }}
                                            </td>
                                            <td style="min-width: 400px; max-width: 800px; white-space: normal;">
                                                {!! nl2br(e(\Illuminate\Support\Str::limit($item->perihal, 1000) ?? '-')) !!}</td>
                                            <td>{{ $item->lampiran ?? '-' }}</td>
                                            <td style="min-width: 300px; max-width: 800px; white-space: normal;">
                                                {!! nl2br(e(\Illuminate\Support\Str::limit($item->tembusan, 400) ?? '-')) !!}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-sm btn-primary ti ti-edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdateSuratKeluarModal-{{ $item->id }}"></button>
                                                    <button type="button" class="btn btn-sm btn-danger ti ti-trash"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeleteSuratKeluarModal-{{ $item->id }}"></button>
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
        </div>
    </div>

    <!-- ==================== MODALS SURAT MASUK ==================== -->

    <!-- Modal Tambah Surat Masuk -->
    <div id="AddSuratMasukModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah Surat Masuk</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('agenda_surat.store_masuk_sekretaris') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Terima Surat <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_terima" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Surat</label>
                                <input type="date" class="form-control" name="tanggal_surat">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No Surat</label>
                                <input type="text" class="form-control" name="no_surat" placeholder="Nomor Surat">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Asal Surat / Dari</label>
                                <input type="text" class="form-control" name="asal_surat"
                                    placeholder="Pengirim Surat">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Perihal <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="perihal" rows="10" placeholder="Isi Perihal Surat" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lampiran</label>
                                <input type="text" class="form-control" name="lampiran"
                                    placeholder="Jumlah/Jenis Lampiran">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Diteruskan Kepada</label>
                                <input type="text" class="form-control" name="diteruskan_kepada"
                                    placeholder="Penerima Lanjut">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Surat Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update Surat Masuk -->
    @foreach ($surat_masuk ?? [] as $item)
        <div id="UpdateSuratMasukModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">Form Update Surat Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('agenda_surat.update_masuk_sekretaris', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Terima Surat</label>
                                    <input type="date" class="form-control" name="tanggal_terima"
                                        value="{{ $item->tanggal_terima ? \Carbon\Carbon::parse($item->tanggal_terima)->format('Y-m-d') : '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Surat</label>
                                    <input type="date" class="form-control" name="tanggal_surat"
                                        value="{{ $item->tanggal_surat ? \Carbon\Carbon::parse($item->tanggal_surat)->format('Y-m-d') : '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No Surat</label>
                                    <input type="text" class="form-control" name="no_surat"
                                        value="{{ $item->no_surat }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Asal Surat / Dari</label>
                                    <input type="text" class="form-control" name="asal_surat"
                                        value="{{ $item->asal_surat }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Perihal</label>
                                    <textarea class="form-control" name="perihal" rows="10">{{ $item->perihal }}</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Lampiran</label>
                                    <input type="text" class="form-control" name="lampiran"
                                        value="{{ $item->lampiran }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Diteruskan Kepada</label>
                                    <input type="text" class="form-control" name="diteruskan_kepada"
                                        value="{{ $item->diteruskan_kepada }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Update Surat Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete Surat Masuk -->
    @foreach ($surat_masuk ?? [] as $item)
        <div id="DeleteSuratMasukModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Surat Masuk</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('agenda_surat.destroy_masuk_sekretaris', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3 text-center">
                                <h5>Apakah Anda yakin ingin menghapus surat masuk<br>
                                    <strong class="text-danger">"{{ $item->perihal }}"</strong>?
                                </h5>
                                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger"><i class="ti ti-trash"></i> Ya,
                                    Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- ==================== MODALS SURAT KELUAR ==================== -->

    <!-- Modal Tambah Surat Keluar -->
    <div id="AddSuratKeluarModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Form Tambah Surat Keluar</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('agenda_surat.store_keluar_sekretaris') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NO. DAN Kode Surat</label>
                                <input type="text" class="form-control" name="nomor_kode_surat"
                                    placeholder="Nomor/Kode Surat">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_surat" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kepada <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="kepada" placeholder="Penerima Surat"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lampiran</label>
                                <input type="text" class="form-control" name="lampiran"
                                    placeholder="Jumlah/Jenis Lampiran">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Perihal <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="perihal" rows="10" placeholder="Isi Perihal Surat" required></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Tembusan</label>
                                <textarea class="form-control" name="tembusan" rows="8" placeholder="Tembusan surat"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Surat Keluar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update Surat Keluar -->
    @foreach ($surat_keluar ?? [] as $item)
        <div id="UpdateSuratKeluarModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">Form Update Surat Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('agenda_surat.update_keluar_sekretaris', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NO. DAN Kode Surat</label>
                                    <input type="text" class="form-control" name="nomor_kode_surat"
                                        value="{{ $item->nomor_kode_surat }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Surat</label>
                                    <input type="date" class="form-control" name="tanggal_surat"
                                        value="{{ $item->tanggal_surat ? \Carbon\Carbon::parse($item->tanggal_surat)->format('Y-m-d') : '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kepada</label>
                                    <input type="text" class="form-control" name="kepada"
                                        value="{{ $item->kepada }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Lampiran</label>
                                    <input type="text" class="form-control" name="lampiran"
                                        value="{{ $item->lampiran }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Perihal</label>
                                    <textarea class="form-control" name="perihal" rows="10">{{ $item->perihal }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Tembusan</label>
                                    <textarea class="form-control" name="tembusan" rows="8">{{ $item->tembusan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Update Surat Keluar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete Surat Keluar -->
    @foreach ($surat_keluar ?? [] as $item)
        <div id="DeleteSuratKeluarModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Surat Keluar</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('agenda_surat.destroy_keluar_sekretaris', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3 text-center">
                                <h5>Apakah Anda yakin ingin menghapus surat keluar<br>
                                    <strong class="text-danger">"{{ $item->perihal }}"</strong>?
                                </h5>
                                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger"><i class="ti ti-trash"></i> Ya,
                                    Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
