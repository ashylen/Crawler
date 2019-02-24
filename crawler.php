<?php
require_once("FUNCTIONS.php");

//SETTINGS

//Disable limits of execution time
set_time_limit(0);

//Hide warnings
libxml_use_internal_errors(true);

//Rest API link to page
$website = 'http://www.rejestradwokatow.pl/adwokat/szczegoly/id/';
$website = 'https://www.rejestradwokatow.pl/adwokat/ewidencja/wykonywanie_zawodu/on/szukaj/Szukaj/strona/';

///SETTINGS

//Get all users from given website
$users = [];
for ($i = 1; $i < 3; $i++)
{
    $users[] = fetchListForIds($website.$i.'/#wyszukiwanie');
}

dump( $users); die;

// $data = [];
// for($i = 49960; $i < 49966; $i++)
// {
//     $data[] = getPageContent($website.$i);

// }

dump($data); die;



// createCSV($data);