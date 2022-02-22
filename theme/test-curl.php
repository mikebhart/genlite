<?php

function get_nav_price( $ticker ) {

    $from_date = date( "Y-m-d", strtotime( "-7 day" ) );
    $to_date = date( "Y-m-d" );
   
    $url = "https://api.nasdaq.com/api/quote/" . $ticker . "/historical?assetclass=mutualfunds&limit=10&fromdate=" . $from_date . '&' . 'todate=' . $to_date;
    
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

        return false;
    }
    
    $result_decoded = json_decode( $result, true );

    $err_message = $result_decoded["status"]["bCodeMessage"][0]["errorMessage"];

    if ( $err_message !== NULL )  {

        error_log( 'KREST PRICE UPDATE ERROR URL=' . $url . ' Error=' . $err_message, 0 );

        return false;
    
    }

    return $result_decoded;

}

$aa = get_nav_price( "KRSTX" );
if ( $aa ) {

    var_dump( $aa );
}


// $ab = get_nav_price( "KRSOX" );
// if ( $ab ) {

//     var_dump( $ab );
// }



