<?php

//Rest API link to page
$website = 'http://www.rejestradwokatow.pl/adwokat/szczegoly/id/49965';

//Hide warnings
libxml_use_internal_errors(true);


//Pretty dumping variables
function dump($data)
{
    if (!is_array($data) && !is_object($data)) {
        print "=========&gt; ";
        var_dump($data);
        print " &lt;=========";
    } else {
        print "<pre>==========================\n";
        print_r($data);
        print "===========================</pre>";
    }
}


//Get specific page content - tables in this specific case
function getPageContent($url)
{
    $tableData = [];
    $tableHeaders = [];
    $nodes = [];

    $doc = new DOMDocument();
    $doc->loadHTML(file_get_contents($url));
    $tableData = $doc->getElementsByTagName('td');
    $tableHeaders = $doc->getElementsByTagName('th');

    foreach($tableData as $key => $td)
    {
        //Trim whitespaces
        $header = trim($tableHeaders[$key]->nodeValue);
        //Remove excessing chars
        $header = str_replace(':', '', $header);
        $nodes[][str_replace(':','', $header)] =  trim($td->nodeValue);
    }

    return $nodes;

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

 createCSV();
$data = getPageContent($website);