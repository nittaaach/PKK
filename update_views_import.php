<?php

$modules = [
    'data_prestasi',
    'gertam',
    'gptp',
    'inventaris',
    'notulen',
    'lap_kegiatan',
    'program_kerja',
    'eval_program',
    'data_ptp',
    'data_potensi'
];

foreach ($modules as $mod) {
    $file = "d:/laragon/www/PKK/resources/views/pokja_3/$mod.blade.php";
    if (!file_exists($file)) continue;

    $content = file_get_contents($file);

    // 1. Change table ID to basic-btn
    $content = preg_replace('/<table\s+id="tbl-[a-zA-Z0-9_-]+"/i', '<table id="basic-btn"', $content);

    // 2. Add Import Button next to Tambah Data button
    $importBtn = '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ImportModal"><i class="ti ti-file-import me-1"></i> Import File</button>';
    if (strpos($content, '#ImportModal') === false) {
        $content = preg_replace('/(<button type="button" class="btn btn-primary([^"]*)" data-bs-toggle="modal" data-bs-target="#AddModal">.*?<\/button>)/s', "$1\n                        $importBtn", $content);
    }

    // 3. Add ImportModal before @endsection
    $importModal = <<<HTML

    <!-- Modal Import -->
    <div id="ImportModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import File Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('Pokja_3.import_{$mod}') }}" method="POST" enctype="multipart/form-data">
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
HTML;

    if (strpos($content, 'id="ImportModal"') === false) {
        $content = preg_replace('/@endsection\s*$/', $importModal, $content);
    }

    file_put_contents($file, $content);
    echo "Updated $file\n";
}
