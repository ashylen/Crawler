<?php

//Rest API link to page
$website = 'http://www.rejestradwokatow.pl/adwokat/szczegoly/id/49965';

//Hide warnings
libxml_use_internal_errors(true);


//Pretty dumping variables
function dump($data)
{
    if (is_array($data)) {
        print "<pre>-----------------------\n";
        print_r($data);
        print "-----------------------</pre>";
    } elseif (is_object($data)) {
        print "<pre>==========================\n";
        print_r($data);
        print "===========================</pre>";
    } else {
        print "=========&gt; ";
        var_dump($data);
        print " &lt;=========";
    }
}


//Get specific page content
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
        dump($tableHeaders[$key]);
        $nodes[] =  $td->nodeValue;
    }
    dump($nodes); die;
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

// createCSV();
dump(getPageContent($website));