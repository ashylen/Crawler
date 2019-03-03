<?php
require_once("FUNCTIONS.php");

//SETTINGS

// Turn off output buffering
ini_set('output_buffering', 'off');
// Turn off PHP output compression
ini_set('zlib.output_compression', false);

//Flush (send) the output buffer and turn off output buffering
while (@ob_end_flush());

// Implicitly flush the buffer(s)
ini_set('implicit_flush', true);
ob_implicit_flush(true);

//Disable limits of execution time
set_time_limit(0);

//Hide warnings
libxml_use_internal_errors(true);

//Link to website
$website = 'https://www.rejestradwokatow.pl/adwokat/szczegoly/id/';

///SETTINGS




//After inserting $users to file, get all those users ID's and execute main script
$ids = file('ids.txt');
$ids = str_getcsv( $ids[0]);

$data = [];
$file = fopen('test.txt', 'wb');

//Set UTF8 charset
fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

$i = 0;
$headers = [];

//Main loop that is getting all informations about user and puts it to CSV
foreach ($ids as $key => $id) {

    if ($key < 3) {
        $url = $website . intval($id);
        $data = getPageContent($url);


        if ($key == 0) {
            foreach ($data as $dataKey => $value) {
                $headers[] = $dataKey;
            }
            fputcsv($file, $headers);
        }else {
            fputcsv($file, $data);
        }
        echo $key.'/'. sizeof($ids);
        echo "<br />";
        flush();
    }

}


fclose($file);

dump('finish');
die;
