@extends('admin-temp.layout_ketua')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Ketua.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">{{ $source_label }}</li>
                        <li class="breadcrumb-item" aria-current="page">Kegiatan</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Kegiatan - {{ $source_label }} <span class="badge bg-info">Lihat Saja</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row"><div class="col-sm-12">
        <div class="card"><div class="card-body">
            <div class="dt-responsive table-responsive">
                <div class="py-3">
                    <button type="button" class="btn btn-success" onclick="printSelected()">
                        <i class="ti ti-printer me-1"></i> Print Laporan
                    </button>
                </div>
                <table id="basic-btn-kegiatan" class="table table-striped table-bordered" style="width:100%;">
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
                            <th rowspan="2" class="align-middle text-center">DOKUMENTASI</th>
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
                        @foreach ($kegiatan as $item)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="selected_ids[]" value="{{ $item->id }}" class="select-item form-check-input">
                                </td>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td style="min-width: 100px; max-width: 300px; white-space: normal;">{{ strtoupper($item->nama ?? '-') }}</td>
                                <td>{{ strtoupper($item->jabatan ?? '-') }}</td>
                                <td>{{ strtoupper($item->kategori ?? '-') }}</td>
                                <td>{{ $item->tanggal_kegiatan ? \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d F Y') : '-' }}</td>
                                <td style="min-width: 200px; max-width: 400px; white-space: normal;">{{ $item->tempat ?? '-' }}</td>
                                <td style="min-width: 400px; max-width: 800px; white-space: normal;">{!! nl2br(e(\Illuminate\Support\Str::limit($item->uraian, 1000) ?? '-')) !!}</td>
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
                                    @php
                                        $dok_ids = json_decode($item->dokumentasi_ids, true) ?? [];
                                        $dok_list = $dok_ids ? \App\Models\Dokumentasi::whereIn('id', $dok_ids)->get() : collect();
                                    @endphp
                                    @if($dok_list->isNotEmpty())
                                        <div class="d-flex flex-wrap gap-1">
                                        @foreach($dok_list as $dok)
                                            <img src="{{ asset('storage/' . $dok->foto) }}" style="width:50px;height:40px;object-fit:cover;border-radius:4px;" title="{{ $dok->caption }}">
                                        @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div></div>
    </div></div>

    <!-- Modal Review Image -->
    @foreach ($kegiatan as $item)
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
