@extends('admin-temp.layout_pokja_2')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_2.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Notulen Rapat</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Notulen Rapat</h2>
                        <p class="text-muted mt-1">TP PKK Kelurahan Cipinang Melayu - Pokja II</p>
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
                    <div class="py-3">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#AddModal">
                            <i class="ti ti-plus me-1"></i> Tambah Notulen
                        </button>
                        <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#ImportModal">
                            <i class="ti ti-file-import me-1"></i> Import File
                        </button>
                        <button type="button" class="btn btn-info" onclick="printSelected()">
                            <i class="ti ti-printer me-1"></i> Print Laporan
                        </button>
                    </div>
                    <table id="basic-btn" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:40px;"><input type="checkbox" id="selectAll"></th>
                                <th class="text-center">NO</th>
                                <th class="text-center">DASAR</th>
                                <th class="text-center">TANGGAL</th>
                                <th class="text-center">WAKTU</th>
                                <th class="text-center">TEMPAT</th>
                                <th class="text-center">ACARA</th>
                                <th class="text-center">PIMPINAN RAPAT</th>
                                <th class="text-center">PESERTA</th>
                                <th class="text-center">ISI NOTULEN</th>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data ?? [] as $item)
                                <tr>
                                    <td class="text-center"><input type="checkbox" name="selected_ids[]" value="{{ $item->id }}" class="select-item form-check-input"></td>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->dasar ?? '-' }}</td>
                                    <td>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : '-' }}</td>
                                    <td>{{ $item->waktu ?? '-' }}</td>
                                    <td>{{ $item->tempat ?? '-' }}</td>
                                    <td>{{ $item->acara ?? '-' }}</td>
                                    <td>{{ $item->pimpinan_rapat ?? '-' }}</td>
                                    <td style="min-width:180px; white-space:normal">{!! nl2br(e($item->peserta ?? '-')) !!}</td>
                                    <td style="min-width:250px; white-space:normal">
                                        <ul style="padding-left: 15px; margin-bottom: 0; font-size: 0.9em;">
                                            @foreach(explode("\n", trim($item->isi_notulen)) as $line)
                                                @if(trim($line))
                                                    <li>{{ \Illuminate\Support\Str::limit($line, 100) }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <button type="button" class="btn btn-sm btn-primary ti ti-edit" data-bs-toggle="modal" data-bs-target="#UpdateModal-{{ $item->id }}"></button>
                                            <button type="button" class="btn btn-sm btn-danger ti ti-trash" data-bs-toggle="modal" data-bs-target="#DeleteModal-{{ $item->id }}"></button>
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

    @include('admin-temp.partials.import_modal', [
        'importRoute' => 'notulen.import_pokja2',
        'title'       => 'Import Data Notulen Pokja II',
        'columns'     => 'no, dasar, tanggal, waktu, tempat, acara, pimpinan_rapat, peserta, isi_notulen, kesimpulan, mengetahui_jabatan, mengetahui_nama, pencatat_nama',
    ])

    <div id="AddModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Notulen Rapat</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('notulen.store_pokja2') }}" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3"><label class="form-label">Dasar (No. Surat)</label><input type="text" class="form-control" name="dasar" placeholder="cth: 001/Pokja II/PKK.Kel/I/2025"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Waktu</label><input type="text" class="form-control" name="waktu" placeholder="cth: 09.00 s.d Selesai"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Tempat</label><input type="text" class="form-control" name="tempat"></div>
                            <div class="col-md-12 mb-3"><label class="form-label">Acara</label><input type="text" class="form-control" name="acara"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Pimpinan Rapat</label><input type="text" class="form-control" name="pimpinan_rapat"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Peserta</label><textarea class="form-control" name="peserta" rows="3" placeholder="Satu per baris"></textarea></div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Isi Notulen <small class="text-muted">(Format per baris: <code>Nama | Uraian</code>)</small></label>
                                <textarea class="form-control" name="isi_notulen" rows="6" placeholder="Contoh:&#10;Ida Faridah | Menjelaskan tentang Program Pokok...&#10;Siti Aminah | Menambahkan terkait administrasi..."></textarea>
                            </div>
                            <div class="col-md-12 mb-3"><label class="form-label">Kesimpulan Rapat</label><textarea class="form-control" name="kesimpulan" rows="3"></textarea></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Mengetahui - Jabatan</label><input type="text" class="form-control" name="mengetahui_jabatan" value="Ketua TP PKK Kec. Makasar"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Mengetahui - Nama</label><input type="text" class="form-control" name="mengetahui_nama" placeholder="Ny. Maya Kamal"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Nama Pencatat</label><input type="text" class="form-control" name="pencatat_nama" placeholder="Nama notulis"></div>
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
                        <h5 class="modal-title">Edit Notulen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('notulen.update_pokja2', $item->id) }}" method="POST">@csrf @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Dasar (No. Surat)</label><input type="text" class="form-control" name="dasar" value="{{ $item->dasar }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal" value="{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') : '' }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Waktu</label><input type="text" class="form-control" name="waktu" value="{{ $item->waktu }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Tempat</label><input type="text" class="form-control" name="tempat" value="{{ $item->tempat }}"></div>
                                <div class="col-md-12 mb-3"><label class="form-label">Acara</label><input type="text" class="form-control" name="acara" value="{{ $item->acara }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Pimpinan Rapat</label><input type="text" class="form-control" name="pimpinan_rapat" value="{{ $item->pimpinan_rapat }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Peserta</label><textarea class="form-control" name="peserta" rows="3">{{ $item->peserta }}</textarea></div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Isi Notulen <small class="text-muted">(Format per baris: <code>Nama | Uraian</code>)</small></label>
                                    <textarea class="form-control" name="isi_notulen" rows="6">{{ $item->isi_notulen }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3"><label class="form-label">Kesimpulan Rapat</label><textarea class="form-control" name="kesimpulan" rows="3">{{ $item->kesimpulan }}</textarea></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Mengetahui - Jabatan</label><input type="text" class="form-control" name="mengetahui_jabatan" value="{{ $item->mengetahui_jabatan }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Mengetahui - Nama</label><input type="text" class="form-control" name="mengetahui_nama" value="{{ $item->mengetahui_nama }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Nama Pencatat</label><input type="text" class="form-control" name="pencatat_nama" value="{{ $item->pencatat_nama }}"></div>
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
                        <form action="{{ route('notulen.destroy_pokja2', $item->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="text-center p-3"><h5>Hapus notulen <strong class="text-danger">{{ $item->acara }}</strong>?</h5></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger"><i class="ti ti-trash"></i> Hapus</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        document.getElementById('selectAll').addEventListener('change', function () {
            document.querySelectorAll('.select-item').forEach(cb => cb.checked = this.checked);
        });
        function printSelected() {
            let selected = [];
            document.querySelectorAll('.select-item:checked').forEach(cb => selected.push(cb.value));
            if (selected.length === 0) { alert('Pilih minimal satu data notulen yang ingin diprint!'); return; }
            window.open("{{ route('notulen.print_report') }}?ids=" + selected.join(',') + "&role=pokja2", '_blank');
        }
    </script>
@endsection
