<?php

//$API_KEY = "1KF99C7HM8CBVDZU";

//$curl_url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=MSFT&apikey=" . $API_KEY;

// curl_setopt_array($curl, array(
//   CURLOPT_URL => $curl_url,
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_HTTPHEADER => array(
//     "cache-control: no-cache",
//     "cookie: $cookie",
//     "x-csrf-token: $token"
//   ),
// ));

// curl -X POST "https://dataondemand.nasdaq.com/api/v1/trades/recurring" \
// -H "accept: application/json" \
// -H "Content-Type: application/json" \
// -H "Authorization: Bearer __token__" \
// -d '{"market_centers": ["string"], "sub_market_centers": ["string"], "symbols": ["AAPL"]}'


function get_nav_price( $ticker ) {

    $yesterday = date("Y-m-d", strtotime("-1 day"));
    $today = date("Y-m-d");
    
    $url = "https://api.nasdaq.com/api/quote/" . $ticker . "/historical?assetclass=mutualfunds&fromdate=" . $yesterday . '&' . 'todate=' . $today;
    
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
    
    $result = curl_exec( $ch );
    $err = curl_error( $ch );
    
    curl_close( $ch );
    
    if ( $err ) {
    
        error_log( 'KREST PRICE UPDATE ERROR URL=' . $url . ' Error=' . $err, 0 );
    
      } else {
    
        $result_decoded = json_decode( $result, true );

        $err_message = $result_decoded["status"]["bCodeMessage"][0]["errorMessage"];
    
        if ( strlen( $err_message) > 0 )  {
    
            error_log( 'KREST PRICE UPDATE ERROR URL=' . $url . ' Error=' . $err_message, 0 );

            return;
    
        }
        
        return $result_decoded;
    
    }

    return;

}

$aa = get_nav_price( "KRSTX" );
var_dump( $aa );

$aa = get_nav_price( "KRSOX" );
var_dump( $aa );

