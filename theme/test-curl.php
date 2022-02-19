<?php



//ini_set("allow_url_fopen", 1);
$API_KEY = "1KF99C7HM8CBVDZU";







// $url="https://api.nasdaq.com/api/quote/KRSTX/historical?assetclass=mutualfunds&fromdate=2022-02-15&limit=9999&todate=2022-02-16";


// echo 'fopen';
// $json = file_get_contents($url);
// $obj = json_decode($json);
// var_dump($obj);

$curl_url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=MSFT&apikey=" . $API_KEY;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $curl_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "cookie: $cookie",
    "x-csrf-token: $token"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {

     # convert json output to PHP array
  $array = json_decode($response, true);

  # output reponse from array back to command line
  echo $array["response"];

}


add_action('http_api_curl', function( $handle ){
    //Don't verify SSL certs
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);

    //Use Charles HTTP Proxy
    curl_setopt($handle, CURLOPT_PROXY, "127.0.0.1");
    curl_setopt($handle, CURLOPT_PROXYPORT, 8888);
 }, 10);

 



// echo 'curl';


// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL,("https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=MSFT&apikey=" . $API_KEY));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $server_output = curl_exec ($ch);
// $result = json_decode($server_output);

// curl_close ($ch);


// var_dump($result);


//echo 'curl';
// $ch = curl_init();
// curl_setopt( $ch, CURLOPT_URL, $url );
// curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

// $result = curl_exec( $ch );
// curl_close( $ch );

// $result_decoded = json_decode( $result, true );

// var_dump($result_decoded);

// exit;


// curl -X POST "https://dataondemand.nasdaq.com/api/v1/trades/recurring" \
// -H "accept: application/json" \
// -H "Content-Type: application/json" \
// -H "Authorization: Bearer __token__" \
// -d '{"market_centers": ["string"], "sub_market_centers": ["string"], "symbols": ["AAPL"]}'

