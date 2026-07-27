@extends('admin-temp.layout_pokja_3')
@section('content_admin')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_3.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Pages</a></li>
                        <li class="breadcrumb-item" aria-current="page">Dokumentasi</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Dokumentasi</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="ktp-rw12" role="tabpanel" aria-labelledby="ktp-rw12-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <div class="py-3 d-flex gap-2 flex-wrap align-items-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#AdddokumModal">
                                        Tambah Dokumentasi
                                    </button>
                                    <button type="button" class="btn btn-success" id="btnPrintMode">
                                        <i class="ti ti-printer"></i> Pilih Foto untuk Print
                                    </button>
                                    <span id="selectedCount" class="badge bg-warning text-dark fs-6 d-none">
                                        0 / 4 foto dipilih
                                    </span>
                                    <button type="button" class="btn btn-danger d-none" id="btnCancelSelect">
                                        Batal
                                    </button>
                                    <button type="button" class="btn btn-info d-none text-white" id="btnDoPrint"
                                        data-bs-toggle="modal" data-bs-target="#PrintPreviewModal">
                                        <i class="ti ti-printer"></i> Lanjut Print
                                    </button>
                                </div>

                                <!-- Alert pilih foto -->
                                <div id="selectAlert" class="alert alert-info d-none" role="alert">
                                    <i class="ti ti-info-circle"></i>
                                    Mode pilih foto aktif. Klik foto atau centang kotak pada tabel untuk memilih (maksimal 4 foto). Klik <strong>Lanjut Print</strong> jika sudah selesai.
                                </div>

                                <table id="basic-btn-rw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="col-pilih">Pilih</th>
                                            <th>Foto</th>
                                            <th>Caption</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dokumentasi as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center align-middle col-pilih">
                                                    <div class="select-checkbox-wrap d-none">
                                                        <input type="checkbox"
                                                            class="foto-checkbox form-check-input fs-5"
                                                            id="check-{{ $item->id }}"
                                                            value="{{ $item->id }}"
                                                            data-foto="{{ asset('storage/' . $item->foto) }}"
                                                            data-caption="{{ $item->caption }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($item->foto)
                                                        <img src="{{ asset('storage/' . $item->foto) }}" width="150"
                                                            class="img-thumbnail foto-select-img"
                                                            style="cursor: pointer;"
                                                            data-item-id="{{ $item->id }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#PreviewFotoModal-{{ $item->id }}">
                                                    @endif
                                                </td>
                                                <td
                                                    style="max-width: 200px; white-space: normal; overflow-wrap: break-word;">
                                                    {{ $item->caption }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdatedokumModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeletedokumModal-{{ $item->id }}">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th class="col-pilih">Pilih</th>
                                            <th>Foto</th>
                                            <th>Caption</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MODAL PRINT PREVIEW ===== -->
    <div class="modal fade" id="PrintPreviewModal" tabindex="-1" aria-labelledby="PrintPreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="PrintPreviewLabel">
                        <i class="ti ti-printer"></i> Preview Cetak Foto Kegiatan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <!-- Form info kegiatan -->
                    <div class="p-4 border-bottom bg-light">
                        <h6 class="fw-bold mb-3 text-muted">Isi Informasi Kegiatan (opsional)</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Hari/Tanggal Kegiatan</label>
                                <input type="text" id="printHariTanggal" class="form-control"
                                    placeholder="Contoh: Senin, 17 Juli 2026">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Nama Kegiatan</label>
                                <input type="text" id="printNamaKegiatan" class="form-control"
                                    placeholder="Contoh: Penyuluhan Kesehatan">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Lokasi</label>
                                <input type="text" id="printLokasi" class="form-control"
                                    placeholder="Contoh: Balai Desa">
                            </div>
                        </div>
                    </div>

                    <!-- PRINT AREA -->
                    <div id="printArea" class="p-4">
                        <div class="print-page">
                            <!-- Header -->
                            <div class="print-header">
                                <div class="print-logo-left">
                                    <img src="{{ asset('assets_admin/images/logo_pkk.png') }}" alt="Logo PKK" class="print-logo-img">
                                </div>
                                <div class="print-title-center">
                                    <h2 class="print-title">FOTO KEGIATAN</h2>
                                </div>
                                <div class="print-logo-right"></div>
                            </div>

                            <!-- Info Kegiatan -->
                            <div class="print-info-section">
                                <table class="print-info-table">
                                    <tr>
                                        <td class="print-info-label">HARI/TANGGAL KEGIATAN</td>
                                        <td class="print-info-colon">:</td>
                                        <td class="print-info-value" id="previewHariTanggal"></td>
                                    </tr>
                                    <tr>
                                        <td class="print-info-label">NAMA KEGIATAN</td>
                                        <td class="print-info-colon">:</td>
                                        <td class="print-info-value" id="previewNamaKegiatan"></td>
                                    </tr>
                                    <tr>
                                        <td class="print-info-label">LOKASI</td>
                                        <td class="print-info-colon">:</td>
                                        <td class="print-info-value" id="previewLokasi"></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- 2x2 Grid Foto -->
                            <div class="print-photos-grid">
                                <div class="print-photo-cell" id="printPhoto1">
                                    <div class="print-photo-inner">
                                        <span class="print-photo-empty">Foto 1</span>
                                    </div>
                                </div>
                                <div class="print-photo-cell" id="printPhoto2">
                                    <div class="print-photo-inner">
                                        <span class="print-photo-empty">Foto 2</span>
                                    </div>
                                </div>
                                <div class="print-photo-cell" id="printPhoto3">
                                    <div class="print-photo-inner">
                                        <span class="print-photo-empty">Foto 3</span>
                                    </div>
                                </div>
                                <div class="print-photo-cell" id="printPhoto4">
                                    <div class="print-photo-inner">
                                        <span class="print-photo-empty">Foto 4</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnExecutePrint">
                        <i class="ti ti-printer"></i> Cetak Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    @foreach ($dokumentasi as $item)
        <!-- Modal Preview Foto -->
        <div class="modal fade" id="PreviewFotoModal-{{ $item->id }}" tabindex="-1"
            aria-labelledby="PreviewFotoLabel-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="PreviewFotoLabel-{{ $item->id }}">Preview Foto Dokumentasi</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid rounded"
                            alt="Foto Dokumentasi">
                        <p class="mt-3 text-muted">{{ $item->caption }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Tambah dokumentasi -->
    <div id="AdddokumModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AdddokumModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah dokumentasi </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form action="{{ route('dokumentasi.store_pokja3') }}" method="POST" enctype="multipart/form-data"
                            class="modal-content">
                            @csrf
                            <div class="card-body">

                                <div class="form-group mb-4">
                                    <label class="form-label">Foto Kegiatan</label>
                                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                                    <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048)</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Caption</label>
                                    <input type="text" class="form-control" name="caption"
                                        placeholder="Masukan Caption">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update dokumentasi -->
    @foreach ($dokumentasi as $item)
        <div id="UpdatedokumModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatedokumModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Form Update dokumentasi </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form action="{{ route('dokumentasi.update_pokja3', $item->id) }}" method="POST"
                                enctype="multipart/form-data" class="modal-content">

                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="form-label">Foto Kegiatan (biarkan kosong jika tidak diganti)</label>
                                        <input type="file" name="foto" class="form-control" accept="image/*">
                                        <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048)</small>
                                        @if ($item->foto)
                                            <div class="mt-2 text-center">
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Lama"
                                                    width="150" class="img-thumbnail">
                                                <p class="text-muted mt-1">Foto Saat Ini</p>
                                            </div>
                                        @endif
                                        @error('foto')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Caption</label>
                                        <input type="text" class="form-control" placeholder="Masukan Caption"
                                            name="caption" value="{{ $item->caption }}">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete dokumentasi -->
    @foreach ($dokumentasi as $item)
        <div id="DeletedokumModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeletedokumModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeletelayananModalTitle-{{ $item->id }}">Hapus Foto Kegiatan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dokumentasi.destroy_pokja3', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3">
                                <div class="form-group">
                                    <label class="form-label">Foto Kegiatan</label>
                                    @if ($item->foto)
                                        <div class="mt-2 text-center">
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Lama"
                                                width="150" class="img-thumbnail">
                                            <p class="text-muted mt-1">Foto Saat Ini</p>
                                        </div>
                                    @endif

                                    @error('foto')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <h5>Yakin ingin menghapus dokumentasi
                                    <strong>{{ $item->caption }}</strong>?
                                </h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="ti ti-trash"></i> Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- STYLES -->
    <style>
        /* ===== PREVIEW STYLES (in modal) ===== */
        .print-page {
            background: #fff;
            border: 1px solid #dee2e6;
            padding: 24px 28px;
            font-family: Arial, sans-serif;
        }

        .print-header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }

        .print-logo-img {
            width: 55px;
            height: auto;
            object-fit: contain;
        }

        .print-logo-left { flex: 0 0 70px; }
        .print-logo-right { flex: 0 0 70px; }
        .print-title-center { flex: 1; text-align: center; }

        .print-title {
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: 2px;
            margin: 0;
            text-transform: uppercase;
        }

        .print-info-section { margin-bottom: 14px; }

        .print-info-table { border-collapse: collapse; }

        .print-info-table td {
            padding: 2px 4px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .print-info-label {
            color: #b56000 !important;
            font-weight: 700 !important;
            width: 230px;
        }

        .print-info-colon { width: 24px; text-align: center; }

        .print-photos-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .print-photo-cell {
            border: 2px solid #000;
            min-height: 220px;
            overflow: hidden;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .print-photo-inner {
            width: 100%;
            min-height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .print-photo-inner img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .print-photo-empty {
            color: #bbb;
            font-size: 1rem;
        }

        /* Selection highlight */
        .foto-select-img.selected-for-print {
            outline: 4px solid #0d6efd;
            border-color: #0d6efd !important;
        }

        tr.row-selected-print {
            background-color: #cfe2ff !important;
        }

        /* ===== PRINT MEDIA ===== */
        @media print {
            body * { visibility: hidden !important; }

            #printArea, #printArea * { visibility: visible !important; }

            #printArea {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                padding: 12mm 15mm !important;
                background: #fff !important;
            }

            .print-page { border: none !important; padding: 0 !important; }

            .print-photo-cell { min-height: 190px; }
            .print-photo-inner { min-height: 190px; }
            .print-photo-inner img { height: 190px; }
        }
    </style>

    <!-- JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const MAX_PHOTOS = 4;
            let selectMode = false;
            let selectedItems = [];

            const btnPrintMode    = document.getElementById('btnPrintMode');
            const btnCancelSelect = document.getElementById('btnCancelSelect');
            const btnDoPrint      = document.getElementById('btnDoPrint');
            const selectedCount   = document.getElementById('selectedCount');
            const selectAlert     = document.getElementById('selectAlert');
            const allCheckboxes   = document.querySelectorAll('.foto-checkbox');
            const allCheckWrap    = document.querySelectorAll('.select-checkbox-wrap');
            const allFotoImgs     = document.querySelectorAll('.foto-select-img');

            // ---- Enter select mode ----
            btnPrintMode.addEventListener('click', function () {
                selectMode = true;
                selectedItems = [];
                resetSelectionUI();

                allCheckWrap.forEach(w => w.classList.remove('d-none'));
                btnPrintMode.classList.add('d-none');
                btnCancelSelect.classList.remove('d-none');
                selectAlert.classList.remove('d-none');
                selectedCount.classList.remove('d-none');
                btnDoPrint.classList.add('d-none');
                updateCount();

                // Disable modal on image click in select mode
                allFotoImgs.forEach(img => {
                    img.setAttribute('data-bs-toggle', '');
                    img.setAttribute('data-bs-target', '');
                });
            });

            // ---- Cancel select mode ----
            btnCancelSelect.addEventListener('click', exitSelectMode);

            function exitSelectMode() {
                selectMode = false;
                selectedItems = [];
                resetSelectionUI();

                allCheckWrap.forEach(w => w.classList.add('d-none'));
                btnPrintMode.classList.remove('d-none');
                btnCancelSelect.classList.add('d-none');
                btnDoPrint.classList.add('d-none');
                selectedCount.classList.add('d-none');
                selectAlert.classList.add('d-none');

                // Re-enable modal on image click
                allFotoImgs.forEach(img => {
                    const id = img.getAttribute('data-item-id');
                    img.setAttribute('data-bs-toggle', 'modal');
                    img.setAttribute('data-bs-target', '#PreviewFotoModal-' + id);
                });
            }

            function resetSelectionUI() {
                allCheckboxes.forEach(cb => cb.checked = false);
                allFotoImgs.forEach(img => img.classList.remove('selected-for-print'));
                document.querySelectorAll('tr.row-selected-print').forEach(r => r.classList.remove('row-selected-print'));
            }

            // ---- Checkbox change ----
            allCheckboxes.forEach(function (cb) {
                cb.addEventListener('change', function () { toggleSelection(this); });
            });

            // ---- Click image to select ----
            allFotoImgs.forEach(function (img) {
                img.addEventListener('click', function (e) {
                    if (!selectMode) return;
                    e.preventDefault();
                    e.stopPropagation();
                    const id = this.getAttribute('data-item-id');
                    const cb = document.getElementById('check-' + id);
                    if (cb) {
                        cb.checked = !cb.checked;
                        toggleSelection(cb);
                    }
                });
            });

            function toggleSelection(cb) {
                const id      = cb.value;
                const foto    = cb.getAttribute('data-foto');
                const caption = cb.getAttribute('data-caption');
                const img     = document.querySelector('.foto-select-img[data-item-id="' + id + '"]');
                const row     = cb.closest('tr');

                if (cb.checked) {
                    if (selectedItems.length >= MAX_PHOTOS) {
                        cb.checked = false;
                        alert('Maksimal 4 foto yang dapat dipilih untuk dicetak.');
                        return;
                    }
                    selectedItems.push({ id, foto, caption });
                    if (img) img.classList.add('selected-for-print');
                    if (row) row.classList.add('row-selected-print');
                } else {
                    selectedItems = selectedItems.filter(i => i.id !== id);
                    if (img) img.classList.remove('selected-for-print');
                    if (row) row.classList.remove('row-selected-print');
                }
                updateCount();
            }

            function updateCount() {
                selectedCount.textContent = selectedItems.length + ' / ' + MAX_PHOTOS + ' foto dipilih';
                btnDoPrint.classList.toggle('d-none', selectedItems.length === 0);
            }

            // ---- Sync info fields to print preview ----
            document.getElementById('printHariTanggal').addEventListener('input', function () {
                document.getElementById('previewHariTanggal').textContent = this.value;
            });
            document.getElementById('printNamaKegiatan').addEventListener('input', function () {
                document.getElementById('previewNamaKegiatan').textContent = this.value;
            });
            document.getElementById('printLokasi').addEventListener('input', function () {
                document.getElementById('previewLokasi').textContent = this.value;
            });

            // ---- Populate photos when print modal opens ----
            document.getElementById('PrintPreviewModal').addEventListener('show.bs.modal', function () {
                for (var i = 1; i <= 4; i++) {
                    var cell  = document.getElementById('printPhoto' + i);
                    var inner = cell.querySelector('.print-photo-inner');
                    var item  = selectedItems[i - 1];
                    if (item) {
                        inner.innerHTML = '<img src="' + item.foto + '" alt="' + (item.caption || '') + '">';
                    } else {
                        inner.innerHTML = '<span class="print-photo-empty">Foto ' + i + '</span>';
                    }
                }
            });

            // ---- Execute print ----
            document.getElementById('btnExecutePrint').addEventListener('click', function () {
                window.print();
            });

            // ---- Reset when print modal is closed ----
            document.getElementById('PrintPreviewModal').addEventListener('hidden.bs.modal', function () {
                exitSelectMode();
                document.getElementById('printHariTanggal').value = '';
                document.getElementById('printNamaKegiatan').value = '';
                document.getElementById('printLokasi').value = '';
                document.getElementById('previewHariTanggal').textContent = '';
                document.getElementById('previewNamaKegiatan').textContent = '';
                document.getElementById('previewLokasi').textContent = '';
            });
        });
    </script>
@endsection

