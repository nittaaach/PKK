<?php

$viewsDir = 'd:\laragon\www\PKK\resources\views';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));
$bladeFiles = [];
foreach ($iterator as $file) {
    if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
        $bladeFiles[] = $file->getPathname();
    }
}

foreach ($bladeFiles as $file) {
    $content = file_get_contents($file);
    if (!str_contains($content, '<tbody') || !str_contains($content, '</tbody')) continue;
    if (str_contains($content, '<tfoot>')) continue; // already has tfoot
    
    if (preg_match('/@foreach\s*\(\$([a-zA-Z0-9_]+)[^\)]*\s+as\s+\$item\)/', $content, $matches)) {
        $varName = $matches[1];
        
        // Find the block from <tbody> to </tbody>
        if (preg_match('/<tbody.*?>.*?<tr.*?>(.*?)<\/tr>/is', $content, $trMatch)) {
            $trContent = $trMatch[1];
            // find all td tags
            preg_match_all('/<td.*?>(.*?)<\/td>/is', $trContent, $tdMatches);
            
            $tdCount = count($tdMatches[0]);
            
            if ($tdCount > 2) {
                $tfoot = "\n                        <tfoot>\n                            <tr class=\"fw-bold bg-light\">\n                                <th colspan=\"2\" class=\"text-center align-middle\">JUMLAH</th>\n";
                // Start from index 2, because 0 is usually iteration, 1 is usually a name/string. ( colspan=2 covers index 0 and 1)
                for ($i = 2; $i < $tdCount; $i++) {
                    $tdInner = $tdMatches[1][$i];
                    
                    if (str_contains($tdInner, 'action') || str_contains($tdInner, 'Action') || str_contains($tdInner, 'button') || str_contains($tdInner, 'modal')) {
                        $tfoot .= "                                <th class=\"text-center\"></th>\n";
                        continue;
                    }
                    
                    if (preg_match('/\{\{\s*\$item->([a-zA-Z0-9_]+).*?\}\}/', $tdInner, $propMatch)) {
                        $prop = $propMatch[1];
                        if (in_array($prop, ['keterangan', 'nama_wilayah', 'wilayah', 'nama_anggota', 'sasaran', 'jenis_kegiatan', 'tanggal', 'tempat', 'status', 'nama_barang', 'asal_barang', 'kondisi'])) {
                            $tfoot .= "                                <th class=\"text-center\"></th>\n";
                        } else {
                            $tfoot .= "                                <th class=\"text-center\">{{ $" . $varName . "->sum('$prop') ?: '-' }}</th>\n";
                        }
                    } else {
                        $tfoot .= "                                <th class=\"text-center\"></th>\n";
                    }
                }
                $tfoot .= "                            </tr>\n                        </tfoot>";
                
                $content = preg_replace('/<\/tbody>/', '</tbody>' . $tfoot, $content, 1);
                file_put_contents($file, $content);
                echo "Added static tfoot to $file\n";
            }
        }
    }
}
echo "Done\n";
