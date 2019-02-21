<?php

//Rest API link to page
$website = 'http://www.rejestradwokatow.pl/adwokat/szczegoly/id/';

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
        if(!empty($tableHeaders[$key]))
            $header = trim($tableHeaders[$key]->nodeValue);




        //Remove excessing chars
        $header = str_replace(':', '', $header);
        dump(trim($td->nodeValue));
        if ($header == 'Status:' && trim($td->nodeValue) == "Wykonujący zawód")
            $nodes[str_replace(':','', $header)] =  trim($td->nodeValue);
    }

    return $nodes;

}

//Create CSV from page content
function createCSV($data)
{

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="sample.csv"');


    $fp = fopen('php://output', 'wb');
    fprintf($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
    $i = 0;
    $headers = [];
    $fields = [];
    foreach ($data as $key => $field) {

        $headers[] = $key;
        $fields[] = $field;

        $i++;
    }

    fputcsv($fp, $headers);
    fputcsv($fp, $fields);
    fclose($fp);
}

$data = [];
for($i = 49960; $i < 49966; $i++)
{
    $data[] = getPageContent($website.$i);

}

dump($data); die;



createCSV($data);