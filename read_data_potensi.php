<?php
require 'vendor/autoload.php';

$zip = new \ZipArchive();
if ($zip->open('d:\laragon\www\PKK\Buku PKK kel cipinang melayu.xlsx') === true) {
    // let's read the shared strings
    $sharedStrings = [];
    if ($xml = simplexml_load_string($zip->getFromName('xl/sharedStrings.xml'))) {
        foreach ($xml->si as $si) {
            if (isset($si->t)) {
                $sharedStrings[] = (string) $si->t;
            } else {
                $str = '';
                foreach ($si->r as $r) {
                    $str .= (string) $r->t;
                }
                $sharedStrings[] = $str;
            }
        }
    }
    
    // let's find the data potensi wilayah sheet
    $sheetPath = '';
    $workbookXml = simplexml_load_string($zip->getFromName('xl/workbook.xml'));
    $relsXml = simplexml_load_string($zip->getFromName('xl/_rels/workbook.xml.rels'));
    
    foreach ($workbookXml->sheets->sheet as $sheet) {
        if (stripos((string)$sheet['name'], 'data potensi sekretaris') !== false) {
            $rId = (string) $sheet['id'];
            foreach ($relsXml->Relationship as $rel) {
                if ((string)$rel['Id'] === $rId) {
                    $sheetPath = 'xl/' . (string)$rel['Target'];
                    break 2;
                }
            }
        }
    }
    
    if (!$sheetPath) $sheetPath = 'xl/worksheets/sheet7.xml'; // fallback to sheet 7
    
    echo "Using sheet: $sheetPath\n";
    $sheetXml = simplexml_load_string($zip->getFromName($sheetPath));
    $rows = [];
    foreach ($sheetXml->sheetData->row as $row) {
        $rowData = [];
        foreach ($row->c as $c) {
            $colIndex = 0;
            $r = (string) $c['r'];
            preg_match('/[A-Z]+/', $r, $matches);
            $colLetters = $matches[0];
            for ($i = 0; $i < strlen($colLetters); $i++) {
                $colIndex = $colIndex * 26 + (ord($colLetters[$i]) - 64);
            }
            $colIndex--;
            
            $val = (string) $c->v;
            if (isset($c['t']) && (string) $c['t'] === 's') {
                $val = $sharedStrings[(int) $val] ?? $val;
            }
            $rowData[$colIndex] = $val;
        }
        $rows[] = $rowData;
    }
    
    // Print first 20 rows
    for ($i=0; $i<min(20, count($rows)); $i++) {
        ksort($rows[$i]);
        echo "Row " . ($i+1) . ": " . json_encode($rows[$i]) . "\n";
    }
}
