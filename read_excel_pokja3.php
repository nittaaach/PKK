<?php
$file = 'D:\\laragon\\www\\PKK\\SURAT MASUK 2025.xlsx';

$zip = new ZipArchive();
$zip->open($file, ZipArchive::RDONLY);

$sharedStrings = [];
$ssXml = $zip->getFromName('xl/sharedStrings.xml');
if ($ssXml !== false) {
    $ss = simplexml_load_string($ssXml);
    foreach ($ss->si as $si) {
        $text = '';
        foreach ($si->r as $r) { $text .= (string)($r->t ?? ''); }
        if (empty($text)) $text = (string)($si->t ?? '');
        $sharedStrings[] = $text;
    }
}

$wb = simplexml_load_string($zip->getFromName('xl/workbook.xml'));
$rels = simplexml_load_string($zip->getFromName('xl/_rels/workbook.xml.rels'));
$relMap = [];
foreach ($rels->Relationship as $rel) {
    $relMap[(string)$rel['Id']] = 'xl/' . (string)$rel['Target'];
}

// Focus only on target sheets
$targets = ['PTP,POTENSI,DTKEGIATAN'];

foreach ($wb->sheets->sheet as $s) {
    $name = (string)$s['name'];
    $rId = (string)$s->attributes('r', true)->id;
    $path = $relMap[$rId] ?? null;
    
    if (!in_array($name, $targets)) continue;
    if (!$path) continue;
    
    echo "======================================" . PHP_EOL;
    echo "SHEET: $name" . PHP_EOL;
    echo "======================================" . PHP_EOL;
    
    $sheetXml = $zip->getFromName($path);
    if (!$sheetXml) { echo "(tidak bisa dibaca)" . PHP_EOL . PHP_EOL; continue; }
    
    $sheet = simplexml_load_string($sheetXml);
    $rows = [];
    
    foreach ($sheet->sheetData->row as $row) {
        $rowData = [];
        $prevCol = -1;
        foreach ($row->c as $cell) {
            $ref = (string)$cell['r'];
            preg_match('/^([A-Z]+)/', $ref, $m);
            $letters = $m[1];
            $colIdx = 0;
            for ($i = 0; $i < strlen($letters); $i++) {
                $colIdx = $colIdx * 26 + (ord($letters[$i]) - 64);
            }
            $colIdx--;
            while ($prevCol < $colIdx - 1) { $rowData[] = null; $prevCol++; }
            
            $type = (string)($cell['t'] ?? '');
            $val = (string)($cell->v ?? '');
            $rowData[] = match($type) {
                's' => $sharedStrings[(int)$val] ?? '',
                'str', 'inlineStr' => (string)($cell->is->t ?? $cell->v ?? ''),
                default => $val
            };
            $prevCol = $colIdx;
        }
        $rows[] = $rowData;
    }
    
    for ($i = 0; $i < min(100, count($rows)); $i++) {
        $filtered = array_filter($rows[$i] ?? [], fn($v) => $v !== null && $v !== '');
        if (!empty($filtered)) {
            echo "Row " . ($i+1) . ": " . json_encode($rows[$i], JSON_UNESCAPED_UNICODE) . PHP_EOL;
        }
    }
    echo PHP_EOL;
}

$zip->close();
