<?php

$file = 'd:/laragon/www/PKK/routes/web.php';
$content = file_get_contents($file);

$modules = [
    'data_prestasi' => 'import_data_prestasi',
    'gertam' => 'import_gertam',
    'gptp' => 'import_gptp',
    'inventaris' => 'import_inventaris',
    'notulen' => 'import_notulen',
    'lap_kegiatan' => 'import_lap_kegiatan',
    'program_kerja' => 'import_program_kerja',
    'eval_program' => 'import_eval_program',
    'data_ptp' => 'import_data_ptp',
    'data_potensi' => 'import_data_potensi'
];

foreach ($modules as $mod => $method) {
    // Look for the POST store route and append the import route after it
    $pattern = "/Route::post\('\/pokja_3\/$mod', \[Pokja3DataController::class, 'store_$mod'\]\)->name\('.*?'\);/";
    
    if (preg_match($pattern, $content, $matches)) {
        $importRoute = "\n    Route::post('/pokja_3/$mod/import', [Pokja3DataController::class, '$method'])->name('Pokja_3.import_$mod');";
        
        // Ensure it doesn't already exist
        if (strpos($content, "'Pokja_3.import_$mod'") === false) {
            $content = str_replace($matches[0], $matches[0] . $importRoute, $content);
        }
    }
}

file_put_contents($file, $content);
echo "Routes updated successfully.\n";
