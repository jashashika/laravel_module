<?php
namespace Module\Core\Helpers;

class FileReader
{

    public static function simpleCsv($sRealFilePath)
    {
        $rCsvFile = fopen($sRealFilePath, "r");
        $aCsvData = array();

        $bIsTitlesRead = false;

        $aTitles = [];
        while (($aData = fgetcsv($rCsvFile, 200, ";")) !== FALSE) {

            if (!$bIsTitlesRead) {
                foreach ($aData as $iIndex => $sValue) {
                    $aTitles[$iIndex] = str_replace(' ', '_', strtolower($sValue));
                }
                $bIsTitlesRead = true;
                continue;
            }

            $aRow = [];
            foreach($aTitles as $iIndex => $sTitle){
                $aRow[$aTitles[$iIndex]] = (is_numeric($aData[$iIndex])) ? doubleval($aData[$iIndex]) : trim($aData[$iIndex]);
            }
            $aCsvData[] = $aRow;
        }
        fclose($rCsvFile);

        return $aCsvData;
    }
}