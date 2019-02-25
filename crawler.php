<?php
require_once("FUNCTIONS.php");

//SETTINGS

//Disable limits of execution time
set_time_limit(0);

//Hide warnings
libxml_use_internal_errors(true);

//Rest API link to page

// $website = 'https://www.rejestradwokatow.pl/adwokat/ewidencja/wykonywanie_zawodu/on/szukaj/Szukaj/strona/';
$website = 'https://www.rejestradwokatow.pl/adwokat/szczegoly/id/';
///SETTINGS

//Get all users from given website
$ids = file('ids.txt');
$ids = str_getcsv( $ids[0]);

$data = [];


$file = fopen('test.txt', 'wb');


fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
$i = 0;
$headers = [];
$fields = [];

// fputcsv($file, $fields);

foreach ($ids as $key => $id) {
    unset( $data);
    if ($key < 5) {
        $url = $website . intval($id);
        $data = getPageContent($url);


    if ($key == 0) {
        foreach ($data as $dataKey => $value) {
            $headers[] = $dataKey;
        }
        fputcsv($file, $headers);
    }else {
        foreach ($data as $value) {
            $fields[] = $value;
        }
        fputcsv($file, $fields);
    }

    }
}


fclose($file);

dump('finish');
die;
