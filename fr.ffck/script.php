<?php

function fnCrawlEvent($year)
{
    $hCurl = curl_init();
    curl_setopt($hCurl, CURLOPT_URL,'http://www.ffck.org/module/calendrier/ajax_calendrier_load.php?type_evenement=COMPOFF,COMPOPEN&mois=&saison='.$year.'&_=1527449726031');
    // curl_setopt($hCurl, CURLOPT_POST, 1);
    // curl_setopt($hCurl, CURLOPT_POSTFIELDS, "postvar1=value1&postvar2=value2&postvar3=value3");
    curl_setopt($hCurl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($hCurl);
    curl_close($hCurl);
    $data = str_replace('<br>', '', $data);
    $data = str_replace('&nbsp;', ' ', $data);
    $data = str_replace('&', 'et', $data);
    $data = substr($data, strpos($data, '<div class="table-responsive">'));
    $data = trim($data);
    $data = '<html><body>'.$data.'</body></html>';

    $oXml = new DOMDocument();
    $oXml->loadXML($data);
    $trNodes = $oXml->getElementsByTagName('tr');
    foreach ($trNodes as $key => $trNode) {
        if ($key == 0) {
            continue;
        }
        foreach ($trNode->childNodes as $childNode) {
            $content = $childNode->C14N();
            $content = trim($content);
            if (empty($content)) {
                continue;
            }
        var_dump($content);

        }
        die();
    }
    die();
}

foreach(array(2017, 2018, 2019) as $year) {
    fnCrawlEvent($year);
}