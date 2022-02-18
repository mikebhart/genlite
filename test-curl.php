<?php
$url="https://api.nasdaq.com/api/quote/KRSTX/historical?assetclass=mutualfunds&fromdate=2022-02-15&limit=9999&todate=2022-02-16";

$ch = curl_init();
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch, CURLOPT_URL, $url );
$result = curl_exec( $ch );
curl_close( $ch );

$result_decoded = json_decode( $result, true );

var_dump($result_decoded);

exit;

