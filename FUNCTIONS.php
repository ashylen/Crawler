<?php

//Pretty dumping variables
function dump($data)
{
    if (!is_array($data) && !is_object($data)) {
        print "=========&gt; ";
        var_dump($data);
        print " &lt;=========";
    } else {
        print "
        <pre>==========================\n";
        print_r($data);
        print "===========================</pre>";
    }
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



//Get specific page content - tables in this specific case
function getPageContent($url)
{
    $tableData = [];
    $tableHeaders = [];
    $nodes = [];
    $name = [];

    $doc = new DOMDocument();
    $doc->loadHTML(file_get_contents($url));
    $tableData = $doc->getElementsByTagName('td');
    $tableHeaders = $doc->getElementsByTagName('th');
    $name = getElementByClass($doc, 'div', 'left');

    foreach ($tableData as $key => $td) {
        //Trim whitespaces
        if (!empty($tableHeaders[$key]))
            $header = trim($tableHeaders[$key]->nodeValue);

        //Remove excessing chars
        $header = str_replace(':', '', $header);
        //Prepare node for proper output
        $node = trim($td->nodeValue);
        $node = nl2br($node);
        $node = preg_replace("/<br\W*?\/>/", "|", $node);
        $node = preg_replace('/\s+/',' ', $node);
        $node = str_replace('| | |' , ' | ' , $node);
        $node = str_replace('| |' , ' | ' , $node);
        $nodes['Nazwa'] = $name[0];
        $nodes[$header] = $node;
    }

    return $nodes;
}

/**
 * Get all user id of each page, then loop throught whole pager
 */
function fetchListForIds($url)
{
    $nodes = [];
    $doc = new DOMDocument();
    $doc->loadHTML(file_get_contents($url));
    $nodes = getElementHrefByClass($doc, 'a', 'link_zobacz');

    return $nodes;
}

function getElementHrefByClass(&$parentNode, $tagName, $className, $offset = 0)
{
    $childNodeList = $parentNode->getElementsByTagName($tagName);
    $results = [];
    $href = null;
    for ($i = 0; $i < $childNodeList->length; $i++) {
        $temp = $childNodeList->item($i);
        if (strpos($temp->getAttribute('class'), $className) !== false) {
                $href = $temp->getAttribute('href');
                $href = str_replace('/adwokat/szczegoly/id/', '', $href);
                $results[] = $href;
        }
    }

    return $results;
}

function getElementByClass(&$parentNode, $tagName, $className, $offset = 0)
{
    $childNodeList = $parentNode->getElementsByTagName($tagName);
    $results = [];
    $href = null;
    for ($i = 0; $i < $childNodeList->length; $i++) {
        $temp = $childNodeList->item($i);
        if ( $temp->getAttribute('class') == $className) {
            $href = trim($temp->nodeValue);
            $results[] = $href;
        }
    }

    return $results;
}