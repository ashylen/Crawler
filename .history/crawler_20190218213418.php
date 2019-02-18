<?php

//Rest API link to page
$website = 'http://www.rejestradwokatow.pl/adwokat/szczegoly/id/';

//Hide warnings
libxml_use_internal_errors(true);

//Get specific page content
function getPageContent($url)
{
    $tables = [];

    $doc = new DOMDocument();
    $doc->loadHTML(file_get_contents($url));
    $tables = $doc->getElementsByTagName('table');

    return $tables;

}

//Create CSV from page content
function createCSV()
{
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="sample.csv"');
    $data = array(
        'aaa,bbb,ccc,dddd',
        '123,456,789',
        '"aaa","bbb"'
    );

    $fp = fopen('php://output', 'wb');
    foreach ($data as $line) {
        $val = explode(",", $line);
        fputcsv($fp, $val);
    }
    fclose($fp);
}

// for($i = 40000; $i < 45000; $i++)
// {
//     echo ' xd'. $i;
// }

dump($_SERVER);
// createCSV();
var_dump(getPageContent($website));