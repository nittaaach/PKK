<?php

$files = [
    'd:/laragon/www/PKK/resources/views/pokja_3/program_kerja.blade.php',
    'd:/laragon/www/PKK/resources/views/pokja_3/eval_program.blade.php',
    'd:/laragon/www/PKK/resources/views/pokja_3/data_ptp.blade.php',
    'd:/laragon/www/PKK/resources/views/pokja_3/data_potensi.blade.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Remove empty <tr></tr>
        $content = str_replace("<tr></tr>", "", $content);
        $content = str_replace("<tr>\n                            </tr>", "", $content);
        $content = str_replace("<tr>\r\n                            </tr>", "", $content);
        
        // Remove rowspan="2"
        $content = str_replace('rowspan="2"', '', $content);
        
        file_put_contents($file, $content);
        echo "Fixed $file\n";
    }
}
