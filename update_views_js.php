<?php
$dirs = ['sekretaris', 'pokja_1', 'pokja_2', 'pokja_3', 'pokja_4'];

foreach ($dirs as $dir) {
    $file = "d:/laragon/www/PKK/resources/views/$dir/daftar_anggota.blade.php";
    if (!file_exists($file)) continue;

    $content = file_get_contents($file);

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
        $content = preg_replace('/@endsection.*/s', $js, $content);
        file_put_contents($file, $content);
        echo "Added JS to $file\n";
    }
}
