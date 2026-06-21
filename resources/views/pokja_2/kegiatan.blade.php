@extends('admin-temp.layout_pokja_2')
@section('content_admin')
    <!-- [ Main Content ] start -->

    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_2.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Administrasi</a></li>
                        <li class="breadcrumb-item" aria-current="page">Buku Kegiatan</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Buku Kegiatan</h2>
                        <p class="text-muted mt-1">TP PKK Kelurahan Cipinang Melayu</p>
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
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#AddKegiatanModal">
                            <i class="ti ti-plus me-1"></i> Tambah Kegiatan
                        </button>
                        <button type="button" class="btn btn-success me-2" data-bs-toggle="modal"
                            data-bs-target="#ImportModal">
                            <i class="ti ti-file-import me-1"></i> Import File
                        </button>
                        <button type="button" class="btn btn-info" onclick="printSelected()">
                            <i class="ti ti-printer me-1"></i> Print Laporan
                        </button>
                    </div>
                    <table id="basic-btn-kegiatan" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle text-center" style="width: 40px;">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th rowspan="2" class="align-middle text-center">NO</th>
                                <th rowspan="2" class="align-middle text-center">NAMA</th>
                                <th rowspan="2" class="align-middle text-center">JABATAN</th>
                                <th rowspan="2" class="align-middle text-center">KATEGORI</th>
                                <th colspan="3" class="align-middle text-center">KEGIATAN</th>
                                <th rowspan="2" class="align-middle text-center">TANDA TANGAN</th>
                                <th rowspan="2" class="align-middle text-center">ACTION</th>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">TANGGAL</th>
                                <th class="align-middle text-center">TEMPAT</th>
                                <th class="align-middle text-center">URAIAN</th>
                            </tr>
                            <!-- Baris Penomoran Kolom -->
                            <tr class="bg-blue-200">
                                <th class="text-center">-</th>
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
                            @foreach ($kegiatan ?? [] as $item)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="selected_ids[]" value="{{ $item->id }}" class="select-item form-check-input">
                                    </td>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td style="min-width: 100px; max-width: 300px; white-space: normal;">
                                        {{ strtoupper($item->nama ?? '-') }}</td>
                                    <td>{{ strtoupper($item->jabatan ?? '-') }}</td>
                                    <td>{{ strtoupper($item->kategori ?? '-') }}</td>
                                    <td>{{ $item->tanggal_kegiatan ? \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d F Y') : '-' }}
                                    </td>
                                    <td style="min-width: 200px; max-width: 400px; white-space: normal;">
                                        {{ $item->tempat ?? '-' }}
                                    </td>
                                    <td style="min-width: 400px; max-width: 800px; white-space: normal;">
                                        {!! nl2br(e(\Illuminate\Support\Str::limit($item->uraian, 1000) ?? '-')) !!}</td>
                                    <td class="text-center">
                                        @if ($item->tanda_tangan)
                                            <img src="{{ asset('storage/' . $item->tanda_tangan) }}" alt="TTD"
                                                style="height: 50px; cursor: pointer;" data-bs-toggle="modal"
                                                data-bs-target="#ImageModal-{{ $item->id }}">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-primary ti ti-edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#UpdateKegiatanModal-{{ $item->id }}">
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger ti ti-trash"
                                                data-bs-toggle="modal"
                                                data-bs-target="#DeleteKegiatanModal-{{ $item->id }}">
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold bg-light">
                                <th colspan="2" class="text-center align-middle">JUMLAH</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center">-</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
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
        'importRoute' => 'kegiatan.import_pokja2',
        'title'       => 'Import Data Kegiatan Pokja 2',
        'columns'     => 'nama, jabatan, kategori, tanggal_kegiatan, tempat, uraian',
    ])

    <!-- Modal Tambah Kegiatan -->
    <div id="AddKegiatanModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah Kegiatan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('kegiatan.store_pokja2') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama Pelaksana"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" placeholder="Jabatan di PKK">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select name="kategori" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    <option value="Piket">Piket</option>
                                    <option value="Rapat">Rapat</option>
                                    <option value="Pemantauan">Pemantauan</option>
                                    <option value="Pelaksanaan Kegiatan">Pelaksanaan Kegiatan</option>
                                    <option value="Pelaksanaan Ceremonial">Pelaksanaan Ceremonial</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Kegiatan <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_kegiatan" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat</label>
                                <input type="text" class="form-control" name="tempat" placeholder="Tempat Kegiatan">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Uraian Kegiatan <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="uraian" rows="10" placeholder="Deskripsi kegiatan yang dilakukan"
                                    required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Upload Tanda Tangan (opsional)</label>
                                <input type="file" name="tanda_tangan" class="form-control"
                                    accept="image/png, image/jpeg, image/jpg">
                                <small class="text-muted">Format: .jpg, .jpeg, .png (max 2MB)</small>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Pilih Dokumentasi (opsional)</label>
                                <div style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                                    @foreach($dokumentasi_list ?? [] as $dok)
                                        <div class="form-check mb-2 d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox" name="dokumentasi_ids[]" value="{{ $dok->id }}" id="dokAdd{{ $dok->id }}" style="margin-right: 10px;">
                                            <label class="form-check-label d-flex align-items-center m-0" for="dokAdd{{ $dok->id }}" style="cursor:pointer;">
                                                <img src="{{ asset('storage/' . $dok->foto) }}" alt="dok" style="height: 40px; width: 40px; object-fit: cover; margin-right: 10px; border-radius: 5px;">
                                                {{ $dok->caption ?? 'Tanpa Caption' }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Kegiatan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update Kegiatan -->
    @foreach ($kegiatan ?? [] as $item)
        <div id="UpdateKegiatanModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">Form Update Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('kegiatan.update_pokja2', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ $item->nama }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan"
                                        value="{{ $item->jabatan }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select name="kategori" class="form-control" required>
                                        <option value="Piket" {{ $item->kategori == 'Piket' ? 'selected' : '' }}>Piket</option>
                                        <option value="Rapat" {{ $item->kategori == 'Rapat' ? 'selected' : '' }}>Rapat</option>
                                        <option value="Pemantauan" {{ $item->kategori == 'Pemantauan' ? 'selected' : '' }}>Pemantauan</option>
                                        <option value="Pelaksanaan Kegiatan" {{ $item->kategori == 'Pelaksanaan Kegiatan' ? 'selected' : '' }}>Pelaksanaan Kegiatan</option>
                                        <option value="Pelaksanaan Ceremonial" {{ $item->kategori == 'Pelaksanaan Ceremonial' ? 'selected' : '' }}>Pelaksanaan Ceremonial</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Kegiatan <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_kegiatan"
                                        value="{{ $item->tanggal_kegiatan ? \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('Y-m-d') : '' }}"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tempat</label>
                                    <input type="text" class="form-control" name="tempat"
                                        value="{{ $item->tempat }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Uraian Kegiatan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="uraian" rows="10" required>{{ $item->uraian }}</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Upload Tanda Tangan Baru (opsional)</label>
                                    <input type="file" name="tanda_tangan" class="form-control"
                                        accept="image/png, image/jpeg, image/jpg">
                                    @if ($item->tanda_tangan)
                                        <small class="text-muted">TTD saat ini:</small>
                                        <img src="{{ asset('storage/' . $item->tanda_tangan) }}" alt="TTD"
                                            style="height: 40px;" class="mt-1">
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Pilih Dokumentasi (opsional)</label>
                                    <div style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                                        @php
                                            $selected_doks = json_decode($item->dokumentasi_ids, true) ?? [];
                                        @endphp
                                        @foreach($dokumentasi_list ?? [] as $dok)
                                            <div class="form-check mb-2 d-flex align-items-center">
                                                <input class="form-check-input" type="checkbox" name="dokumentasi_ids[]" value="{{ $dok->id }}" id="dokEdit{{ $item->id }}_{{ $dok->id }}" {{ in_array($dok->id, $selected_doks) ? 'checked' : '' }} style="margin-right: 10px;">
                                                <label class="form-check-label d-flex align-items-center m-0" for="dokEdit{{ $item->id }}_{{ $dok->id }}" style="cursor:pointer;">
                                                    <img src="{{ asset('storage/' . $dok->foto) }}" alt="dok" style="height: 40px; width: 40px; object-fit: cover; margin-right: 10px; border-radius: 5px;">
                                                    {{ $dok->caption ?? 'Tanpa Caption' }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Update Kegiatan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete Kegiatan -->
    @foreach ($kegiatan ?? [] as $item)
        <div id="DeleteKegiatanModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Data Kegiatan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kegiatan.destroy_pokja2', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3 text-center">
                                <h5>
                                    Apakah Anda yakin ingin menghapus kegiatan <br>
                                    <strong class="text-danger">"{{ $item->uraian }}"</strong>?
                                </h5>
                                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="ti ti-trash"></i> Ya, Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Modal Review Image -->
    @foreach ($kegiatan ?? [] as $item)
        @if ($item->tanda_tangan)
            <div id="ImageModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Review Tanda Tangan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset('storage/' . $item->tanda_tangan) }}" alt="Tanda Tangan"
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        function printSelected() {
            let selected = [];
            document.querySelectorAll('.select-item:checked').forEach(checkbox => {
                selected.push(checkbox.value);
            });

            if (selected.length === 0) {
                alert('Pilih data yang ingin diprint!');
                return;
            }

            let url = "{{ route('kegiatan.print_report') }}?ids=" + selected.join(',');
            window.open(url, '_blank');
        }
    </script>
@endsection
