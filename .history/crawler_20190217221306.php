<?php

$website = 'http://www.rejestradwokatow.pl/adwokat/ewidencja/szukaj/Szukaj';
$website = 'http://www.rejestradwokatow.pl/adwokat/szczegoly/id/49965';

//Hide warnings
libxml_use_internal_errors(true);

//Get specific page content
function getPageContent($url)
{
    $tables = [];

    $doc = new DOMDocument();
    $doc->loadHTML(file_get_contents($url));
    $tables = $doc->getElementsByTagName('table');

    foreach($tables as $table)
    {
       echo $table->nodeValue; 
    }
    return $tables;

}

// for($i = 40000; $i < 45000; $i++)
// {
//     echo ' xd'. $i;
// }

var_dump(getPageContent($website));