<?php
require "../bootstrap.php";

getMarsTime('8 Feb 2020 06:45:17 UTC');

function getMarsTime($date) {
    echo "Calculating date on Mars for date : $date ...";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/time/" . $date);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    var_dump($response);
}
