<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

foreach(DB::table('inventaris_pokja3')->get() as $row) { 
    if (is_numeric($row->tanggal_penerimaan) && $row->tanggal_penerimaan > 20000) { 
        $date = gmdate('d/m/Y', ($row->tanggal_penerimaan - 25569) * 86400); 
        DB::table('inventaris_pokja3')->where('id', $row->id)->update(['tanggal_penerimaan' => $date]); 
        echo "Updated inventaris row {$row->id} to {$date}\n";
    } 
}

echo "Done.\n";
