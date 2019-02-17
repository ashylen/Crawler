<?php

$website = 'http://www.rejestradwokatow.pl/adwokat/ewidencja/szukaj/Szukaj';
$website = 'http://www.rejestradwokatow.pl/adwokat/szczegoly/id/49965';

//Hide warnings
libxml_use_internal_errors(true);


function getPageContent($url)
{
    $doc = new DOMDocument();
    $doc->loadHTML(file_get_contents($url));

    return $doc;

}

for($i = 40000; $i < 45000; $i++)
{
    echo ' xd'. $i;
}

echo getPageContent($website);