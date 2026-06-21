<?php
require 'vendor/autoload.php';

$zip = new \ZipArchive();
if ($zip->open('d:\laragon\www\PKK\Buku PKK kel cipinang melayu.xlsx') === true) {
    $workbookXml = simplexml_load_string($zip->getFromName('xl/workbook.xml'));
    $relsXml = simplexml_load_string($zip->getFromName('xl/_rels/workbook.xml.rels'));
    
    $sharedStrings = [];
    $ssXml = $zip->getFromName('xl/sharedStrings.xml');
    if ($ssXml !== false) {
        $ss = simplexml_load_string($ssXml);
        if ($ss) {
            foreach ($ss->si as $si) {
                $text = '';
                foreach ($si->r as $r) {
                    $text .= (string) ($r->t ?? '');
                }
                if (empty($text)) $text = (string) ($si->t ?? '');
                $sharedStrings[] = $text;
            }
        }
    }

    foreach ($workbookXml->sheets->sheet as $sheet) {
        $name = (string)$sheet['name'];
        if (stripos($name, 'potensi') !== false || stripos($name, 'umum') !== false) {
            echo "--- SHEET: $name ---\n";
            $rId = (string) $sheet->attributes('r', true)->id;
            $sheetPath = '';
            foreach ($relsXml->Relationship as $rel) {
                if ((string)$rel['Id'] === $rId) {
                    $sheetPath = 'xl/' . (string)$rel['Target'];
                    break;
                }
            }
            
            $sheetXml = simplexml_load_string($zip->getFromName($sheetPath));
            $rows = [];
            foreach ($sheetXml->sheetData->row as $row) {
                $rowData = [];
                $prevColIndex = -1;
                foreach ($row->c as $cell) {
                    $ref = (string) $cell['r'];
                    preg_match('/^([A-Z]+)(\d+)$/', $ref, $m);
                    $colLetter = $m[1] ?? 'A';
                    $colIndex = 0;
                    for ($i = 0, $len = strlen($colLetter); $i < $len; $i++) {
                        $colIndex = $colIndex * 26 + (ord($colLetter[$i]) - ord('A') + 1);
                    }
                    $colIndex--;
                    
                    while ($prevColIndex < $colIndex - 1) {
                        $rowData[] = null;
                        $prevColIndex++;
                    }
                    
                    $type = (string) ($cell['t'] ?? '');
                    $value = (string) ($cell->v ?? '');
                    
                    if ($type === 's') {
                        $rowData[] = $sharedStrings[(int) $value] ?? '';
                    } elseif ($type === 'str' || $type === 'inlineStr') {
                        $rowData[] = (string) ($cell->is->t ?? $cell->v ?? '');
                    } else {
                        $rowData[] = $value;
                    }
                    
                    $prevColIndex = $colIndex;
                }
                
                $filtered = array_filter($rowData, function($v) { return $v !== "" && $v !== null; });
                if (!empty($filtered)) {
                    $rows[] = $rowData;
                }
            }
            
            for ($i=0; $i<min(15, count($rows)); $i++) {
                echo "Row $i: " . json_encode($rows[$i]) . "\n";
            }
        }
    }
}
