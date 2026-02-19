<?php


	function get_nav_price( $ticker, $to_date ) {

		$from_date = date( "Y-m-d", strtotime( "-7 day" ) );

        $url = "https://api.nasdaq.com/api/quote/" . $ticker . "/historical" . '?assetclass=mutualfunds&fromdate=' . $from_date . '&todate='. $to_date;

		echo 'URL Used=' . $url;
 	
		$ch = curl_init($url);

		//Instantiate User Agent
		$config['useragent'] = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36';

//		$config['useragent'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36';
	
		curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
		curl_setopt($ch, CURLOPT_REFERER, 'https://www.nasdaq.com/');
	
		//Create an array of custom headers.
		$customHeaders = array(
				'Authority: api.nasdaq.com',
				'Accept: */*',
				'Origin: https://www.nasdaq.com',
				'Sec-fetch-site: same-site',
				'Sec-fetch-mode: cors',
				'Sec-fetch-dest: empty',
				'Accept-language: en-US,en;q=0.9',
				'Accept-Encoding: deflate',
				'Connection: keep-alive'
		);
	
		curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeaders);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	
		$result = curl_exec($ch);

		echo $result;
		// $err = curl_error( $ch );
		
		// curl_close( $ch );
		
	
		// $result_decoded = json_decode( $result, true );

	
		// return $result_decoded;
	
	}

	

	$to_date_minus_day = date( "Y-m-d", strtotime( "-1 day" ) );
	$to_date = date( "Y-m-d" );


	$class_i_price = get_nav_price( "KRSTX", $to_date );

	//var_dump($class_i_price);

	
	


