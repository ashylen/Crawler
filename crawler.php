<?php
require_once("FUNCTIONS.php");

//SETTINGS

//Disable limits of execution time
set_time_limit(0);

//Hide warnings
libxml_use_internal_errors(true);

//Rest API link to page

$website = 'https://www.rejestradwokatow.pl/adwokat/ewidencja/wykonywanie_zawodu/on/szukaj/Szukaj/strona/';
$website = 'http://www.rejestradwokatow.pl/adwokat/szczegoly/id/';
///SETTINGS

//Get all users from given website
// $users = [];
// for ($i = 50; $i < 372; $i++)
// {
//     $users = array_merge(fetchListForIds($website.$i.'/#wyszukiwanie'), $users);
// }

$data = [];
for($i = 40683; $i < 40685; $i++)
{
    $data[] = getPageContent($website.$i);

}

dump($data); die;



// createCSV($data);