<?php

require_once("FUNCTIONS.php");

//SETTINGS

$website = 'https://www.rejestradwokatow.pl/adwokat/ewidencja/wykonywanie_zawodu/on/szukaj/Szukaj/strona/';

///SETTINGS

//Get all users from given website's list

$users = [];
for ($i = 1; $i < 5; $i++)
{
    $data[] = getPageContent($website.$i);
    $users = array_merge(fetchListForIds($website.$i.'/#wyszukiwanie'), $users);

}

dump($users);