<?php
$zip = new \ZipArchive();
if ($zip->open('d:\laragon\www\PKK\Buku PKK kel cipinang melayu.xlsx') === true) {
    $workbookXml = simplexml_load_string($zip->getFromName('xl/workbook.xml'));
    foreach ($workbookXml->sheets->sheet as $s) {
        echo (string)$s['name'] . "\n";
    }
}
