{{--
    Import Modal Partial
    Parameters:
    - $modalId      : ID unik modal (default 'ImportModal')
    - $importRoute  : route name untuk action form
    - $routeParams  : array parameter route (optional)
    - $title        : judul modal
    - $columns      : string deskripsi kolom yang diperlukan
--}}
@php
    $modalId     = $modalId ?? 'ImportModal';
    $title       = $title ?? 'Import Data';
    $routeParams = $routeParams ?? [];
@endphp

<!-- Modal Import -->
<div id="{{ $modalId }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="ti ti-file-import me-2"></i>{{ $title }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route($importRoute, $routeParams) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <strong><i class="ti ti-info-circle me-1"></i>Format file yang diterima:</strong>
                        <ul class="mb-1 mt-1">
                            <li><strong>.xlsx / .xls</strong> &mdash; Microsoft Excel</li>
                            <li><strong>.csv</strong> &mdash; Comma Separated Values</li>
                            <li><strong>.ods</strong> &mdash; LibreOffice / Google Spreadsheet</li>
                        </ul>
                    </div>
                    @if(!empty($columns))
                    <div class="alert alert-warning small">
                        <i class="ti ti-table me-1"></i>
                        <strong>Header kolom yang diperlukan:</strong><br>
                        <code>{{ $columns }}</code>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="import_file" accept=".xlsx,.xls,.csv,.ods" required>
                        <div class="form-text">Ukuran maksimal: 5 MB</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="ti ti-upload me-1"></i> Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
