<?php
$dirs = ['sekretaris', 'pokja_1', 'pokja_2', 'pokja_3', 'pokja_4'];

foreach ($dirs as $dir) {
    $file = "d:/laragon/www/PKK/resources/views/$dir/daftar_anggota.blade.php";
    if (!file_exists($file)) continue;

    $content = file_get_contents($file);

    // Replace Add Form Select
    $addPattern = '/<select\s+class="form-select"\s+name="status_perkawinan">\s*<option\s+value="">-- Pilih --<\/option>\s*<option\s+value="Kawin">Kawin<\/option>\s*<option\s+value="Belum Kawin">Belum Kawin<\/option>\s*<\/select>/s';
    
    $addReplacement = <<<HTML
<select class="form-select" name="status_perkawinan" onchange="toggleLainnya(this)">
                                    <option value="">-- Pilih --</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <input type="text" class="form-control mt-2 status-perkawinan-lainnya" name="status_perkawinan_lainnya" placeholder="Sebutkan..." style="display: none;">
HTML;

    $content = preg_replace($addPattern, $addReplacement, $content);

    // Replace Update Form Input
    $updatePattern = '/<label\s+class="form-label">Status Perkawinan<\/label>\s*<input\s+type="text"\s+class="form-control"\s+name="status_perkawinan"\s*value="\{\{\s*\$item->status_perkawinan\s*\}\}">/s';
    
    $updateReplacement = <<<HTML
@php
                                        \$isLainnya = !in_array(\$item->status_perkawinan, ['', 'Kawin', 'Belum Kawin', 'Cerai Mati', 'Cerai Hidup']) && !empty(\$item->status_perkawinan);
                                    @endphp
                                    <label class="form-label">Status Perkawinan</label>
                                    <select class="form-select" name="status_perkawinan" onchange="toggleLainnya(this)">
                                        <option value="">-- Pilih --</option>
                                        <option value="Kawin" {{ \$item->status_perkawinan == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                        <option value="Belum Kawin" {{ \$item->status_perkawinan == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                        <option value="Cerai Mati" {{ \$item->status_perkawinan == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                        <option value="Cerai Hidup" {{ \$item->status_perkawinan == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                        <option value="Lainnya" {{ \$isLainnya ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    <input type="text" class="form-control mt-2 status-perkawinan-lainnya" name="status_perkawinan_lainnya" placeholder="Sebutkan..." value="{{ \$isLainnya ? \$item->status_perkawinan : '' }}" style="{{ \$isLainnya ? '' : 'display: none;' }}">
HTML;

    $content = preg_replace($updatePattern, $updateReplacement, $content);

    // Add JavaScript if not exists
    if (strpos($content, 'toggleLainnya(selectElement)') === false) {
        $js = <<<HTML
<script>
    function toggleLainnya(selectElement) {
        var inputElement = selectElement.nextElementSibling;
        if (inputElement && inputElement.classList.contains('status-perkawinan-lainnya')) {
            if (selectElement.value === 'Lainnya') {
                inputElement.style.display = 'block';
                inputElement.required = true;
            } else {
                inputElement.style.display = 'none';
                inputElement.required = false;
                inputElement.value = '';
            }
        }
    }
</script>
@endsection
HTML;
        $content = preg_replace('/@endsection\s*$/s', $js, $content);
    }

    file_put_contents($file, $content);
    echo "Updated $file\n";
}
