<?php

$website = 'http://www.rejestradwokatow.pl/adwokat/ewidencja/szukaj/Szukaj';


function follow_links($url)
{
    $doc = new DOMDocument();
    $doc->loadHTML(file_get_contents($url));

}

follow_links($website);