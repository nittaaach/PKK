<?php
require 'vendor/autoload.php';

$zip = new \ZipArchive();
if ($zip->open('d:\laragon\www\PKK\Buku PKK kel cipinang melayu.xlsx') === true) {
    $workbookXml = $zip->getFromName('xl/workbook.xml');
    $relsXml = $zip->getFromName('xl/_rels/workbook.xml.rels');
    
    $sheetPath = 'xl/worksheets/sheet1.xml'; // default
    
    if ($workbookXml && $relsXml) {
        $wb = simplexml_load_string($workbookXml);
        $rels = simplexml_load_string($relsXml);
        
        $activeTab = (int)($wb->bookViews->workbookView['activeTab'] ?? 0);
        
        $sheets = [];
        foreach ($wb->sheets->sheet as $sheet) {
            $sheets[] = (string)$sheet->attributes('r', true)->id;
        }
        
        if (isset($sheets[$activeTab])) {
            $rId = $sheets[$activeTab];
            foreach ($rels->Relationship as $rel) {
                if ((string)$rel['Id'] === $rId) {
                    $sheetPath = 'xl/' . (string)$rel['Target'];
                    break;
                }
            }
        }
    }
    
    echo "Resolved sheet path: " . $sheetPath . "\n";
}
