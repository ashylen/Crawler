<?php

$website = 'http://www.rejestradwokatow.pl/adwokat/ewidencja/szukaj/Szukaj';
$website = 'http://www.rejestradwokatow.pl/adwokat/szczegoly/id/49965';

libxml_use_internal_errors(true);

function follow_links($url)
{
    $doc = new DOMDocument();
    $doc->loadHTML(file_get_contents($url));
    
    
}

follow_links($website);