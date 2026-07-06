<?php
$zip = new ZipArchive;
$zip->open('d:/laragon/www/PKK/SURAT MASUK 2025.xlsx');
$xml = simplexml_load_string($zip->getFromName('xl/workbook.xml'));
foreach($xml->sheets->sheet as $s) {
    echo $s['name'] . "\n";
}
